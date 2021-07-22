<?php

namespace Epl\Sincronizador\Application\Handlers;

use Epl\Sincronizador\Domain\Contracts\SincronizarDataIRepository;
use Epl\Sincronizador\Application\Contracts\Handler;
use Epl\Sincronizador\Domain\Constants\Constant;
use Epl\Sincronizador\Domain\Services\DescargaArchivoZip;
use Epl\Sincronizador\Domain\Services\ExistenciaData;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class DescargaArchivoZipHandler implements Handler
{
	private $repository;
	private $archivo_zip_tienda;

	public function __construct(SincronizarDataIRepository $repository)
	{
		$this->repository = $repository;
		$this->service = new ExistenciaData();
	}

	public function __invoke($command)
	{
		$descomprimir = false;

		$this->descargar($command);

		$descomprimir = $this->guardarArchivoLocal($command);		

		if ($descomprimir) {
			// validarArchivosParaProcesar
		}
	}

	private function descargar($command): void
	{
		if ($this->repository->existeArchivoZip($command->getArchivo(), $command->getArchivar())) {
			if ($this->archivo_zip_tienda = $this->repository->descargar($command->getArchivo(), $command->getArchivar())) {
				$this->repository->eliminarArchivoZip($command->getArchivo(), $command->getArchivar());
			}
		} else {
			Log::warning("[{$command->getTraza()}][DESCARGA ARCHIVO ZIP HANDLER][ALMACEN][{$command->getAlmacen()}][TIENDA][{$command->getTienda()}] [ALERTA] NO SE ENCONTRO INFORMACIÓN PARA SINCRONIZAR");
		}
	}

	private function guardarArchivoLocal($command): bool
	{
		$archivoZipLocal = DescargaArchivoZip::archivoZipLocal($command->getTienda());
		$carpetaDataDescarga = DescargaArchivoZip::carpetaDataDescarga($command->getTienda());
		$rutaArchivoZipLocal = DescargaArchivoZip::rutaArchivoZipLocal($command->getTienda());

		if ($this->repository->subirData($archivoZipLocal, $this->archivo_zip_tienda, $command->getArchivar())) {
			Log::debug("[{$command->getTraza()}][DESCARGA ARCHIVO ZIP HANDLER][ALMACEN][{$command->getAlmacen()}][TIENDA][{$command->getTienda()}][ALERTA] Archivo descargado de la nube y guardado localmente: {$archivoZipLocal}.");

			$this->repository->limpiarCarpetaData($carpetaDataDescarga, $command->getArchivar());
			
			return $this->repository->descomprimirData($rutaArchivoZipLocal, $carpetaDataDescarga);
		}
	}
}
