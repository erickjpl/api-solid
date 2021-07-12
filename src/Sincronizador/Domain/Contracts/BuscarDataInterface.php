<?php

namespace Epl\Sincronizador\Domain\Contracts;

interface BuscarDataInterface
{
  public function buscarData(string $traza, string $opcion, string $tienda, array $fecha): array;
}
