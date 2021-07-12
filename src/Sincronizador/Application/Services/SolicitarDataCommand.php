<?php

namespace Epl\Sincronizador\Application\Services;

use Epl\Sincronizador\Application\Contracts\Command;
use Epl\Sincronizador\Domain\Exceptions\ParametrosIncorrectos;

final class SolicitarDataCommand implements Command
{
	private string $tipo;
	private string $opcion;
	private string $tienda;
	private array $fecha;

	public function __construct(array $payload)
	{
		try {
			$this->tipo = $payload['tipo'];
			$this->opcion = $payload['opcion'];
			$this->tienda = $payload['tienda'];
			$this->fecha = $payload['fecha'] ?? [];
		} catch (ParametrosIncorrectos $e) {
			throw $e;
		}
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
