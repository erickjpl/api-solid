<?php

namespace Epl\Sincronizador\Application\Services;

use Epl\Sincronizador\Application\Contracts\Command;
final class DescargaArchivoZipCommand implements Command
{
	private $traza;
	private $tienda;
	private $archivo;
	private $archivar;
	private $almacen;

	public function __construct(string $traza, string $almacen, string $archivo, string $tienda, string $archivar)
	{
		$this->traza = $traza;
		$this->tienda = $tienda;
		$this->archivo = $archivo;
		$this->almacen = $almacen;
		$this->archivar = $archivar;
	}

	/**
	 * Get the value of traza
	 */ 
	public function getTraza()
	{
		return $this->traza;
	}

	/**
	 * Get the value of almacen
	 */ 
	public function getAlmacen()
	{
		return $this->almacen;
	}

	/**
	 * Get the value of archivo
	 */ 
	public function getArchivo()
	{
		return $this->archivo;
	}

	/**
	 * Get the value of tienda
	 */ 
	public function getTienda()
	{
		return $this->tienda;
	}

	/**
	 * Get the value of archivar
	 */ 
	public function getArchivar()
	{
		return $this->archivar;
	}
}
