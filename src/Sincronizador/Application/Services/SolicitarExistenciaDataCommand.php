<?php

namespace Epl\Sincronizador\Application\Services;

use Epl\Sincronizador\Application\Contracts\Command;

final class SolicitarExistenciaDataCommand implements Command
{
	private $tiendas;
	private $almacen;

	public function __construct(string $almacen, string $tiendas = [])
	{
    $this->almacen = $almacen;
    $this->tiendas = $tiendas;
	}

	/**
	 * Get the value of almacen
	 */ 
	public function getAlmacen()
	{
		return $this->almacen;
	}

	/**
	 * Get the value of tiendas
	 */ 
	public function getTiendas()
	{
		return $this->tiendas;
	}
}
