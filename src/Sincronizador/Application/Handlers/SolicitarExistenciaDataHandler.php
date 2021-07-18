<?php

namespace Epl\Sincronizador\Application\Handlers;

use Epl\Sincronizador\Domain\Contracts\SincronizarDataIRepository;
use Epl\Sincronizador\Application\Contracts\Handler;
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
		$tiendas = $this->service->validarTiendas($command->getTienda(), $command->getAlmacen());
		$this->service->existeArchivoParaDescargar($tiendas);
	}
}
