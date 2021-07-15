<?php

namespace Epl\Sincronizador\Application\Handlers;

use Epl\Sincronizador\Domain\Contracts\SincronizarDataIRepository;
use Epl\Sincronizador\Infrastructure\Eloquent\ConnectionRepository;
use Epl\Sincronizador\Domain\Services\SeleccionarClass;
use Epl\Sincronizador\Application\Contracts\Handler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Epl\Sincronizador\Domain\Entities\ConnectionEntity;

final class BuscarDataHandler implements Handler
{
	private $tiendas;
	private $repository;
	private $conexionRepo;
	private $actConexionRepo;

	const TODAS_TIENDAS = 'all';
	const TIPO_ESPECIAL = array('matriz', 'profit');

	public function __construct(SincronizarDataIRepository $repository)
	{
		$this->repository = $repository;
		$this->conexionRepo = new CasoUsoValidarConexionTienda(new ConnectionRepository());
		$this->actConexionRepo = new CasoUsoActualizarConexionTienda(new ConnectionRepository());
		$this->tiendas = array(Str::lower(config('app.almacenes')));
	}

	public function __invoke($command)
	{
		$fecha = $this->validarFechaInicioTienda($command);

		if ($this->validarTipoEspecial($command->getTipo())) {
			if ($this->todasTiendas($command->getTienda())) {
				foreach ($this->tiendas as $tienda) {
					$this->sincronizar($command->getTraza(), $command->getTienda(), $command->getOpcion(), $fecha[$tienda]);
				}
			} else {
				$this->sincronizar($command->getTraza(), $command->getTienda(), $command->getOpcion(), $fecha[$command->getTienda()]);
			}
		} else { $this->sincronizar($command->getTraza(), $command->getTienda(), $command->getOpcion(), $fecha); }
	}

	private function validarTipoEspecial($command)
	{
		return in_array($command, self::TIPO_ESPECIAL);
	}

	private function todasTiendas($command)
	{
		return $command == self::TODAS_TIENDAS;
	}

	private function validarFechaInicioTienda($command): array
	{
		/** Obtener la fecha enviada por el usuario */
		$fecha = $command->getFecha();

		if ($this->validarTipoEspecial($command->getTipo())) {
			if ($this->todasTiendas($command->getTienda())) {
				$fechas = collect();
				foreach ($this->tiendas as $tienda) {
					$entity = $this->buscarFechaTienda($tienda);
					$resultado = $this->validarFechaTienda($entity, $fecha);
					$fechas->push($resultado);
				}
				return $fechas->toArray();
			} else {
				$entity = $this->buscarFechaTienda($command->getTienda());
				return $this->validarFechaTienda($entity, $fecha);
			}
		}

		return $command->getFecha();
	}

	private function sincronizar(string $traza, string $tienda, string $opcion, array $fecha): void
	{
		/** Busca la clase que se necesita implementar para buscar la data que debe subir para sincronizar */
		$class = SeleccionarClass::opcionBuscar($tienda);
		$sincronizar = $class->obtenerClass($traza, $opcion, $tienda, $fecha);
		$this->archivarData($sincronizar);
	}

	private function buscarFechaTienda(string $tienda)
	{
		/** Buscar el inicio de la fecha registrada en la última conexión de sincronización */
		return $this->conexionRepo->execute($tienda);
	}

	private function validarFechaTienda(ConnectionEntity $entity, array $fecha): array
	{
		if ($entity->getStatus() == 0) {
			$model_start_date = Carbon::parse($entity->getStartDate());
			$solicitud = Carbon::parse($fecha['start_date']);

			/** Si la fecha del Modelo es menir que la solicitada se actualiza la variable de start_date para la busqueda */
			if ($model_start_date < $solicitud) { $fecha['start_date'] = $model_start_date; }
			else { $this->actConexionRepo->execute(array('start_date' => $fecha['start_date']), $entity->getId()); }
		} else {
			$this->actConexionRepo->execute(array('start_date' => $fecha['start_date'], 'status' => '0'), $entity->getId());
		}

		return array($entity->getShop() => $fecha);
	}

	private function archivarData(array $data)
	{
		foreach ($data as $opcion) {
			try {
				$casoUso = $this->mapCasoUso($opcion['class']);
				$model = $casoUso->execute($opcion['query']);
				$this->repository->guardarData($opcion['path'], $model);
			} catch (\Exception $e) {
				Log::debug("[ERROR] {$e->getMessage()}");
			}
		}
	}

	private function mapCasoUso($class)
	{
		$casoUso = "\\Epl\\Sincronizador\\Application\\Handlers\\Profit\\CasoUso{$class}";
		$repository = "\\Epl\\Sincronizador\\Infrastructure\\Eloquent\\Profit\\{$class}Repository";
		return new $casoUso(new $repository());
	}
}
