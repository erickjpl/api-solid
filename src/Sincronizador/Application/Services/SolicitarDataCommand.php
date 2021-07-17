<?php

namespace Epl\Sincronizador\Application\Services;

use Epl\Sincronizador\Application\Contracts\Command;
use Epl\Sincronizador\Domain\Exceptions\ParametrosIncorrectos;

final class SolicitarDataCommand implements Command
{
	private $tipo;
	private $fecha;
	private $opcion;
	private $tienda;
	private $almacen;

	public function __construct(string $almacen, string $tipo, string $opcion, string $tienda, array $payload = [])
	{
		try {
			$this->tipo = $tipo;
			$this->opcion = $opcion;
			$this->tienda = $tienda;
			$this->fecha = $payload;
			$this->almacen = $almacen;
		} catch (ParametrosIncorrectos $e) {
			throw $e;
		}
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
}
