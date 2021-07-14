<?php

namespace Epl\Sincronizador\Application\Handlers\Profit;

use Epl\Sincronizador\Domain\Contracts\InterfaceRespository;
use Epl\Sincronizador\Domain\Exceptions\RegistroNoEncontrado;

class CasoUsoZona
{
  public function __construct(InterfaceRespository $repository)
	{
		$this->repository = $repository;
	}

	public function execute(array $query)
	{
    $entity = $this->repository->all($query);

    if ($entity->isNotEmpty()) return $entity;

    throw new RegistroNoEncontrado("Zona no encontrado.");
	} 
}
