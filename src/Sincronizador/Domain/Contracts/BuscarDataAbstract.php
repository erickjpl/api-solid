<?php

namespace Epl\Sincronizador\Domain\Contracts;

abstract class BuscarDataAbstract
{
  protected $repository;

  public function __construct(SincronizarDataIRepository $repository)
  {
    $this->repository = $repository;
  }

  abstract public function buscarData(string $traza, string $opcion, string $tienda, array $fecha): array;

	public function guardarData($path, $data)
  {
    return $this->repository->guardarData($path, $data);
  }
}