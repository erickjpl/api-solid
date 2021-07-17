<?php

namespace Epl\Sincronizador\Application\Services;

use Epl\Sincronizador\Application\Contracts\Command;
final class BuscarDataCommand implements Command
{
	private $tipo;
	private $fecha;
	private $traza;
	private $opcion;
	private $tienda;
	private $almacen;

	public function __construct(string $almacen, string $traza, string $tipo, string $opcion, string $tienda, array $fecha)
	{
		$this->tipo = $tipo;
		$this->fecha = $fecha;
		$this->traza = $traza;
		$this->opcion = $opcion;
		$this->tienda = $tienda;
		$this->almacen = $almacen;
	}

	/**
	 * Get the value of almacen
	 */ 
	public function getAlmacen()
	{
		return $this->almacen;
	}

	/**
	 * Get the value of tipo
	 */ 
	public function getTipo()
	{
		return $this->tipo;
	}

	/**
	 * Get the value of opcion
	 */ 
	public function getOpcion()
	{
		return $this->opcion;
	}

	/**
	 * Get the value of tienda
	 */ 
	public function getTienda()
	{
		return $this->tienda;
	}

	/**
	 * Get the value of fecha
	 */ 
	public function getFecha()
	{
		return $this->fecha;
	}

	/**
	 * Get the value of traza
	 */ 
	public function getTraza()
	{
		return $this->traza;
	}
}
