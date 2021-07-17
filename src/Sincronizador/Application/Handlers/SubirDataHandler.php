<?php

namespace Epl\Sincronizador\Application\Handlers;

use Epl\Sincronizador\Domain\Contracts\SincronizarDataIRepository;
use Epl\Sincronizador\Application\Contracts\Handler;
use Epl\Sincronizador\Domain\Services\SubirData;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class SubirDataHandler implements Handler
{
	private $service;
	private $repository;

	public function __construct(SincronizarDataIRepository $repository)
	{
		$this->repository = $repository;
		$this->service = new SubirData();
	}

	public function __invoke($command)
	{
		$this->almacen = $command->getAlmacen();
		$carpeta_data = $this->service->carpetaData($command->getTienda());
		$archivo_zip = $this->service->archivoZip($command->getTienda());
		$notificar = $this->service->notificar($command->getArchivar(), $command->getTienda(), $this->almacen);

		if ($this->comprimir($command->getTraza(), $carpeta_data, $archivo_zip)) {
			$this->subir($command->getTraza(), $notificar['ruta'], $archivo_zip, $command->getArchivar());
		}
	}

	private function comprimir(string $traza, string $carpeta_data, string $archivo_zip): bool
	{
		Log::debug("[$traza][SUBIR DATA HANDLER][RUTA] {$archivo_zip}");
		return $this->repository->comprimirData($carpeta_data, $archivo_zip);
	}

	public function subir(string $traza, string $carpeta_data, string $archivo_zip, string $archivar): bool
	{
		Log::debug("[$traza][SUBIR][{$archivar}][RUTA] {$carpeta_data}");
		return $this->repository->subirData($carpeta_data, $archivo_zip, $archivar);
	}
}
