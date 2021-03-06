<?php

namespace Epl\Sincronizador\Application\Handlers;

use Epl\Sincronizador\Domain\Contracts\InterfaceRespository;
use Epl\Sincronizador\Domain\Exceptions\RegistroNoEncontrado;

final class CasoUsoActualizarConexionTienda
{
	public function __construct(InterfaceRespository $repository)
	{
		$this->repository = $repository;
	}

	public function execute(array $update, $index)
	{
		try {
      $entity = $this->repository->update($update, $index);

      return $entity;
    } catch (RegistroNoEncontrado $exception) {
      throw new RegistroNoEncontrado($exception);
    }
	}
}
