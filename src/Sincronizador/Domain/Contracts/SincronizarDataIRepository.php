<?php

namespace Epl\Sincronizador\Domain\Contracts;

interface SincronizarDataIRepository
{
  public function encolarBuscarData(string $traza, string $tipo, string $opcion, string $tienda, array $fecha, string $almacen): void;

  public function guardarData(string $path, $data): bool;

  public function subirData(string $traza, string $tienda, string $almacen): void;
}
