<?php

namespace Epl\Sincronizador\Domain\Contracts;

interface BuscarClassInterface
{
  public function obtenerClass(string $traza, string $opcion, string $tienda, array $fecha): array;
}
