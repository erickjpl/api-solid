<?php

namespace Epl\Sincronizador\Application\Handlers;

use Epl\Sincronizador\Domain\Contracts\SincronizarDataIRepository;
use Epl\Sincronizador\Application\Contracts\Handler;
use Epl\Sincronizador\Domain\Services\SubirData;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class SubirDataHandler implements Handler
{
	private $repository;

	public function __construct(SincronizarDataIRepository $repository)
	{
		$this->repository = $repository;
	}

	public function __invoke($command)
	{
		$this->almacen = $command->getAlmacen();
		$carpeta_data = SubirData::carpetaData($command->getTienda());
		$archivo_zip = SubirData::archivoZip($command->getTienda());
		$notificar = SubirData::notificar($command->getTienda());
	}
}
