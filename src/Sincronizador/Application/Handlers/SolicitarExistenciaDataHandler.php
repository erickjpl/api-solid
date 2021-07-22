<?php

namespace Epl\Sincronizador\Application\Handlers;

use Epl\Sincronizador\Domain\Contracts\SincronizarDataIRepository;
use Epl\Sincronizador\Application\Contracts\Handler;
use Epl\Sincronizador\Domain\Constants\Constant;
use Epl\Sincronizador\Domain\Services\ExistenciaData;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class SolicitarExistenciaDataHandler implements Handler
{
	private $service;
	private $repository;

	public function __construct(SincronizarDataIRepository $repository)
	{
		$this->repository = $repository;
		$this->service = new ExistenciaData();
	}

	public function __invoke($command)
	{
		$tiendas = $this->service->validarTiendas($command->getArchivar(), $command->getTiendas(), $command->getAlmacen());

		foreach ($tiendas as $tienda => $path) {
			$archivo = $path.'/'.Constant::DATA_ZIP;
			$traza = Str::random(6);
			if ($this->repository->existeArchivoZip($archivo, $command->getArchivar())) {
				$this->repository->encolarDescargaArchivoZip($traza, $command->getAlmacen(), $archivo, $tienda);			
        Log::debug("[$traza][SOLICITAR EXISTENCIA DATA HANDLER][ALMACEN][{$command->getAlmacen()}][BUSCAR] {$archivo} [TIENDA] {$tienda}");
			} else {
        Log::warning("[$traza][SOLICITAR EXISTENCIA DATA HANDLER][ALMACEN][{$command->getAlmacen()}][ALERTA] NO SE ENCONTRO INFORMACIÓN PARA SINCRONIZAR [TIENDA] {$tienda}");
			}
		}
	}
}
