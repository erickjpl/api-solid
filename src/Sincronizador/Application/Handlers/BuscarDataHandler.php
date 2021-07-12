<?php

namespace Epl\Sincronizador\Application\Services;

use Carbon\Carbon;
use Epl\Sincronizador\Domain\Services\BuscarData;
use Epl\Sincronizador\Application\Contracts\Handler;
use Epl\Sincronizador\Domain\Contracts\BuscarDataInterface;
use Epl\Sincronizador\Domain\Contracts\InterfaceRespository;

final class BuscarDataHandler implements Handler
{
	private $repository;
	private InterfaceRespository $iRepo;
	private ValidarConexionTiendaCasoUso $conexionRepo;
	private ActualizarConexionTiendaCasoUso $actConexionRepo;
	private ArchivarDataCasoUso $archivarRepo;

	public function __construct(BuscarDataInterface $repository)
	{
		$this->repository = $repository;
		$this->conexionRepo = new ValidarConexionTiendaCasoUso($this->iRepo);
		$this->actConexionRepo = new ActualizarConexionTiendaCasoUso($this->iRepo);
		$this->archivarRepo = new ArchivarDataCasoUso($this->iRepo);
	}

	public function __invoke($command)
	{
		$service = new BuscarData();

		$this->repository = $service->opcionBuscar($command->getTienda());

		$fecha = $this->validarTienda($command);

		$data = $this->repository->buscarData($command->getTraza(), $command->getOpcion(), $command->getTienda(), $fecha);

		$this->archivarData($data);

	}

	private function validarTienda($command): array
	{
		if ($command->getTienda() == 'profit') {
			$entity = $this->conexionRepo->execute($command->getTienda());
			$fecha = $command->getTienda();

			if ($entity->getStatus() == 0) {
				$model_start_date = Carbon::parse($entity->getStartDate())->addDays(-10);
				$ahora = Carbon::parse($fecha['start_date']);
	
				/** Si la fecha de la DB es mayor que la solicitada se actualiza la variable de start_date para la busqueda */
				if ($model_start_date < $ahora) { $fecha['start_date'] = $model_start_date; }
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
			$this->archivarRepo->execute($opcion['class'], $opcion['path'], $opcion['query']);
		}
	}
}
