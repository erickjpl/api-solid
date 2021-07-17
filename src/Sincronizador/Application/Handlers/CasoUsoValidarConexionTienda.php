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
		try {
			$model = $this->repository->first(array('shop' => $tienda), array('id', 'shop', 'start_date', 'status'));
	
			return ConnectionEntity::fromDto($model);
		} catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			throw new RegistroNoEncontrado("La tienda no tiene registro de conexión.");
		}
	}
}
