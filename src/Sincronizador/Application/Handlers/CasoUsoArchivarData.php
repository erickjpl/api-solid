<?php

namespace Epl\Sincronizador\Application\Handlers;

use Epl\Sincronizador\Domain\Contracts\InterfaceRespository;
use Exception;

final class CasoUsoArchivarData
{
	public function __construct(InterfaceRespository $repository)
	{
		$this->repository = $repository;
	}

	public function execute(array $query)
	{
		try {
      return $this->repository->all($query, 'row_id');
    } catch (Exception $exception) {
      throw $exception;
    }
	}
}
