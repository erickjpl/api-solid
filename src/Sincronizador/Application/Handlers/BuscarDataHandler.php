<?php

namespace Epl\Sincronizador\Application\Handlers;

use Carbon\Carbon;
use Epl\Sincronizador\Application\Contracts\Handler;
use Epl\Sincronizador\Domain\Services\SeleccionarClass;
use Epl\Sincronizador\Domain\Contracts\InterfaceRespository;
use Illuminate\Support\Facades\Log;

final class BuscarDataHandler implements Handler
{
	private $repository;
	private $conexionRepo;
	private $actConexionRepo;

	public function __construct(InterfaceRespository $repository)
	{
		$this->repository = $repository;
		$this->conexionRepo = new CasoUsoValidarConexionTienda($repository);
		$this->actConexionRepo = new CasoUsoActualizarConexionTienda($repository);
	}

	public function __invoke($command)
	{
		$fecha = $this->validarFechaInicioTienda($command);

		/** Busca la clase que se necesita implementar para buscar la data que debe subir para sincronizar */
		// $class = SeleccionarClass::opcionBuscar($command->getTienda());
		// $sincronizar = $class->obtenerClass($command->getTraza(), $command->getOpcion(), $command->getTienda(), $fecha);
		// $this->archivarData($sincronizar);
	}

	private function validarFechaInicioTienda($command): array
	{
		if ($command->getTipo() == 'profit' || $command->getTipo() == 'matriz') {
			/** Buscar el inicio de la fecha registrada en la última conexión de sincronización */
			$entity = $this->conexionRepo->execute($command->getTienda());

			/** Obtener la fecha enviada por el usuario */
			$fecha = $command->getFecha();

			if ($entity->getStatus() == 0) {
				$model_start_date = Carbon::parse($entity->getStartDate());
				$solicitud = Carbon::parse($fecha['start_date']);

				Log::debug($entity);
	
				/** Si la fecha del Modelo es menir que la solicitada se actualiza la variable de start_date para la busqueda */
				if ($model_start_date < $solicitud) { $fecha['start_date'] = $model_start_date; }
				else { $this->actConexionRepo->execute(array('start_date' => $fecha['start_date']), $entity->getId()); }
			} else {
				$this->actConexionRepo->execute(array('start_date' => $fecha['start_date'], 'status' => '0'), $entity->getId());
			}

			return array('start_date' => $fecha['start_date'], 'end_date' => $fecha['end_date']);
		}

		return $command->getFecha();
	}

	private function archivarData(array $data)
	{
		foreach ($data as $opcion) {
			$casoUso = $this->mapCasoUso($opcion['class']);
			$model = $casoUso->execute($opcion['query']);
			// $this->repository->guardarData($opcion['path'], $model);
		}
	}

	private function mapCasoUso($class)
	{
		$casoUso = "\\Epl\\Sincronizador\\Application\\Handlers\\Profit\\CasoUso".$class;
		return new $casoUso($this->repository);
	}
}
