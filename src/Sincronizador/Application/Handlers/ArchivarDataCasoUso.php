<?php

namespace Epl\Sincronizador\Application\Services;

use Epl\Sincronizador\Domain\Contracts\InterfaceRespository;
use Exception;

final class ArchivarDataCasoUso
{
	public function __construct(InterfaceRespository $repository)
	{
		$this->repository = $repository;
	}

	public function execute($class, $path, $query)
	{
		try {
      $this->repository->all($query, 'row_id');
    } catch (Exception $exception) {
      throw $exception;
    }
	}
}
