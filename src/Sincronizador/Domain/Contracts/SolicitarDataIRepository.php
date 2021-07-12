<?php

namespace Epl\Sincronizador\Domain\Contracts;

interface SolicitarDataIRepository
{
  public function encolarBuscarData(string $traza, string $tipo, string $opcion, string $tienda, array $fecha, string $almacen): void;
}
