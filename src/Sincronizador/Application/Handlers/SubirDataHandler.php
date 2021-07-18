<?php

namespace Epl\Sincronizador\Application\Handlers;

use Epl\Sincronizador\Infrastructure\Eloquent\ConnectionRepository;
use Epl\Sincronizador\Domain\Contracts\SincronizarDataIRepository;
use Epl\Sincronizador\Domain\Exceptions\ErrorSubiendoData;
use Epl\Sincronizador\Application\Contracts\Handler;
use Epl\Sincronizador\Domain\Constants\Constant;
use Epl\Sincronizador\Domain\Services\SubirData;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class SubirDataHandler implements Handler
{
	private $service;
	private $repository;
	private $conexionRepo;
	private $actConexionRepo;

	public function __construct(SincronizarDataIRepository $repository)
	{
		$this->repository = $repository;
		$this->service = new SubirData();
		$this->conexionRepo = new CasoUsoValidarConexionTienda(new ConnectionRepository());
		$this->actConexionRepo = new CasoUsoActualizarConexionTienda(new ConnectionRepository());
	}

	public function __invoke($command)
	{
		$flag = false;
		$this->almacen = $command->getAlmacen();
		$carpeta_data = $this->service->carpetaData($command->getTienda());
		$archivo_zip = $this->service->archivoZip($command->getTienda());
		$notificar = $this->service->notificar($command->getArchivar(), $command->getTienda(), $this->almacen);

		/** Obtener registro de conexción de la tienda */
		$conexion = $this->conexionRepo->execute($command->getTienda());

		try {
			if ($this->comprimir($command->getTraza(), $carpeta_data, $archivo_zip)) {
				$flag = $this->subir($command->getTraza(), $notificar['ruta'], $archivo_zip, $command->getArchivar());
			}
		} catch (\Exception $e) {
			$this->actConexionRepo->execute(array('status' => '0'), $conexion->getId());
			Log::error("[{$command->getTraza()}][SUBIR DATA HANDLER][COMPRIMIR-SUBIR][RUTA] {$e->getMessage()}");
			throw $e;
		}

		if ($flag) {
			$this->notificar($command->getTraza(), $flag, $conexion->getId(), $notificar['uri'], $carpeta_data, $archivo_zip, $command->getArchivar());
		}
	}

	private function comprimir(string $traza, string $carpeta_data, string $archivo_zip): bool
	{
		Log::debug("[$traza][SUBIR DATA HANDLER][COMPRIMIR][RUTA] {$archivo_zip}");
		return $this->repository->comprimirData($carpeta_data, $archivo_zip);
	}

	private function subir(string $traza, string $carpeta_data, string $archivo_zip, string $archivar): bool
	{
		try {
			Log::debug("[$traza][SUBIR][{$archivar}][RUTA] {$carpeta_data}");
			return $this->repository->subirData($carpeta_data, $archivo_zip, $archivar);
		} catch (\Exception $e) {
			Log::error("[$traza][ERROR][SUBIR][{$archivar}][RUTA] {$carpeta_data}. Ocurrio un error subiendo el archivo zip con la data.");
			throw new ErrorSubiendoData("Ocurrio un error subiendo el archivo zip con la data:. {$e->getMessage()}");			
		}
	}

	private function notificar(string $traza, bool $flag, int $id, string $uri, string $carpeta_data, string $archivo_zip, string $archivar)
	{
		if ($flag) {
			$this->actConexionRepo->execute(array('status' => '1'), $id);

			$response = $this->repository->notificarSubidaData($uri);
			Log::debug("[$traza][SUBIR DATA HANDLER][NOTIFICAR][{$uri}] [RESPUESTA]: {$response}");

			$this->repository->eliminarArchivoZip(Str::replaceFirst(Constant::APP, '', $archivo_zip), $archivar);
			$this->repository->limpiarCarpetaData(Str::replaceFirst(Constant::APP, '', $carpeta_data), $archivar);
		} else {
			$this->actConexionRepo->execute(array('status' => '0'), $id);
		}
	}
}
