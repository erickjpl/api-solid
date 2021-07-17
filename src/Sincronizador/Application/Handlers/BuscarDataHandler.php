<?php

namespace Epl\Sincronizador\Application\Handlers;

use Epl\Sincronizador\Infrastructure\Eloquent\ConnectionRepository;
use Epl\Sincronizador\Domain\Contracts\SincronizarDataIRepository;
use Epl\Sincronizador\Domain\Entities\ConnectionEntity;
use Epl\Sincronizador\Domain\Services\SeleccionarClass;
use Epl\Sincronizador\Application\Contracts\Handler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

final class BuscarDataHandler implements Handler
{
	private $almacen;
	private $tiendas;
	private $repository;
	private $conexionRepo;
	private $actConexionRepo;

	public function __construct(SincronizarDataIRepository $repository)
	{
		$this->repository = $repository;
		$this->conexionRepo = new CasoUsoValidarConexionTienda(new ConnectionRepository());
		$this->actConexionRepo = new CasoUsoActualizarConexionTienda(new ConnectionRepository());
		$this->tiendas = Str::of(Str::lower(config('app.almacenes')))->explode(';')->toArray();
	}

	public function __invoke($command)
	{
		$this->almacen = $command->getAlmacen();
		$fecha = $this->validarFechaInicioTienda($command);

		if (SeleccionarClass::validarTipoEspecial($command->getTipo(), $this->almacen)) {
			if (SeleccionarClass::ejecutarTodasTiendas($command->getTienda())) {
				foreach ($this->tiendas as $tienda) {
					if (SeleccionarClass::excluirTiendas($tienda)) { continue; }
					$this->sincronizar($command->getTraza(), $tienda, $command->getOpcion(), $fecha[$tienda]);
				}
			} else {
				$this->sincronizar($command->getTraza(), $command->getTienda(), $command->getOpcion(), $fecha[$command->getTienda()]);
			}
		} else { $this->sincronizar($command->getTraza(), $command->getTienda(), $command->getOpcion(), $fecha); }
	}

	private function validarFechaInicioTienda($command): array
	{
		/** Obtener la fecha enviada por el usuario */
		$fecha = $command->getFecha();

		if (SeleccionarClass::validarTipoEspecial($command->getTipo(), $this->almacen)) {
			if (SeleccionarClass::ejecutarTodasTiendas($command->getTienda())) {
				$fechas = collect();
				foreach ($this->tiendas as $tienda) {
					if (SeleccionarClass::excluirTiendas($tienda)) { continue; }
					$fechas->put($tienda, $this->executeCasoUso($tienda, $fecha));
				}
				return $fechas->all();
			} else {
				return array($command->getTienda() => $this->executeCasoUso($command->getTienda(), $fecha));
			}
		}

		return $command->getFecha();
	}

	private function sincronizar(string $traza, string $tienda, string $opcion, array $fecha): void
	{
		/** Busca la clase que se necesita implementar para buscar la data que debe subir para sincronizar */
		$class = SeleccionarClass::opcionBuscar($tienda);
		$sincronizar = $class->obtenerClass($traza, $opcion, $tienda, $fecha);
		$this->archivarData($traza, $sincronizar, $tienda);
	}

	public function executeCasoUso(string $tienda, array $fecha): array
	{
		try {
			$entity = $this->buscarFechaTienda($tienda);
			return $this->validarFechaTienda($entity, $fecha);
		} catch (\Exception $e) {
			return $fecha;
		}
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

		return $fecha;
	}

	private function archivarData(string $traza, array $data, string $tienda)
	{
		foreach ($data as $opcion) {
			try {
				$casoUso = $this->mapCasoUso($opcion['class']);
				$model = $casoUso->execute($opcion['query']);
				$this->repository->guardarData($opcion['path'], $model->toJson());
			} catch (\Exception $e) {
				Log::error("[BUSCAR DATA HANDLER][ARCHIVAR DATA][CLASS][{$opcion['class']}][ERROR] {$e->getMessage()}");
				continue;
			}
		}
		
		$this->repository->subirData($traza, $tienda, $this->almacen);
	}

	private function mapCasoUso($class)
	{
		$casoUso = "\\Epl\\Sincronizador\\Application\\Handlers\\Profit\\CasoUso{$class}";
		$repository = "\\Epl\\Sincronizador\\Infrastructure\\Eloquent\\Profit\\{$class}Repository";
		return new $casoUso(new $repository());
	}
}
