<?php

namespace Epl\Sincronizador\Application\Services;

use Epl\Sincronizador\Application\Contracts\Command;
final class SubirDataCommand implements Command
{
	private $traza;
	private $tienda;
	private $archivar;
	private $almacen;

	public function __construct(string $archivar, string $almacen, string $traza, string $tienda)
	{
		$this->traza = $traza;
		$this->tienda = $tienda;
		$this->almacen = $almacen;
		$this->archivar = $archivar;
	}

	/**
	 * Get the value of archivar
	 */ 
	public function getArchivar()
	{
		return $this->archivar;
	}

	/**
	 * Get the value of almacen
	 */ 
	public function getAlmacen()
	{
		return $this->almacen;
	}

	/**
	 * Get the value of traza
	 */ 
	public function getTraza()
	{
		return $this->traza;
	}

	/**
	 * Get the value of tienda
	 */ 
	public function getTienda()
	{
		return $this->tienda;
	}
}
