<?php

namespace Epl\Sincronizador\Application\Services;

use Epl\Sincronizador\Application\Contracts\Command;

final class SolicitarExistenciaDataCommand implements Command
{
	private $archivar;
	private $almacen;
	private $tiendas;

	public function __construct(string $archivar, string $almacen, mixed $tiendas = null)
	{
    $this->archivar = $archivar;
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

	/**
	 * Get the value of archivar
	 */ 
	public function getArchivar()
	{
		return $this->archivar;
	}
}
