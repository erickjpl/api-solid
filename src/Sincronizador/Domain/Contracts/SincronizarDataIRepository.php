<?php

namespace Epl\Sincronizador\Domain\Contracts;

interface SincronizarDataIRepository
{
  public function encolarBuscarData(string $traza, string $tipo, string $opcion, string $tienda, array $fecha, string $almacen): void;

  public function guardarData(string $path, $data): bool;

  public function tareaSubirData(string $traza, string $tienda, string $almacen): void;

  public function comprimirData(string $carpeta, string $archivo): bool;

  public function subirData(string $ruta_carpeta, string $archivo, string $archivar): bool;
}
