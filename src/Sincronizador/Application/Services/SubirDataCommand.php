<?php

namespace Epl\Sincronizador\Application\Services;

use Epl\Sincronizador\Application\Contracts\Command;
final class SubirDataCommand implements Command
{
	private $traza;
	private $tienda;
	private $archivo;
	private $almacen;

	public function __construct(string $archivo, string $almacen, string $traza, string $tienda)
	{
		$this->traza = $traza;
		$this->tienda = $tienda;
		$this->archivo = $archivo;
		$this->almacen = $almacen;
	}

	/**
	 * Get the value of archivo
	 */ 
	public function getArchivo()
	{
		return $this->archivo;
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
