<?php

namespace Epl\Sincronizador\Domain\Contracts;

use Illuminate\Support\Facades\Log;

abstract class BuscarDataAbstract
{
  protected $repository;

  public function __construct(InterfaceRespository $repository)
  {
    $this->repository = $repository;
  }

  public function execute($payload)
	{
		try {
      return $this->repository->all([], array('row_id'));
    } catch (\Exception $exception) {
      throw $exception;
    }
	}
}