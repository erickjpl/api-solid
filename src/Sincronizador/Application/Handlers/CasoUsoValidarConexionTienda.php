<?php

namespace Epl\Sincronizador\Application\Handlers;

use Epl\Sincronizador\Domain\Entities\ConnectionEntity;
use Epl\Sincronizador\Domain\Contracts\InterfaceRespository;
use Exception;

final class CasoUsoValidarConexionTienda
{
	public function __construct(InterfaceRespository $repository)
	{
		$this->repository = $repository;
	}

	public function execute($tienda): ?ConnectionEntity
	{
		try {
      return ConnectionEntity::fromDto($this->repository->first(array('shop' => $tienda), array('id', 'status', 'start_date')));
    } catch (Exception $exception) {
      throw $exception;
    }
	}
}
