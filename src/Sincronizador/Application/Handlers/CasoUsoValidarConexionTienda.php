<?php

namespace Epl\Sincronizador\Application\Handlers;

use Epl\Sincronizador\Domain\Entities\ConnectionEntity;
use Epl\Sincronizador\Domain\Contracts\InterfaceRespository;
use Epl\Sincronizador\Domain\Exceptions\RegistroNoEncontrado;
use Exception;

final class CasoUsoValidarConexionTienda
{
	public function __construct(InterfaceRespository $repository)
	{
		$this->repository = $repository;
	}

	public function execute($tienda): ?ConnectionEntity
	{
		$model = $this->repository->first(array('shop' => $tienda), array('id', 'shop', 'start_date', 'status'));

		if ($model) { return ConnectionEntity::fromDto($model); }

		throw new RegistroNoEncontrado("Conexión de tienda no encontrado");	
	}
}
