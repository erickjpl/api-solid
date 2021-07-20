<?php

namespace Epl\Sincronizador\Domain\Contracts;

interface SincronizarDataIRepository
{
  public function encolarBuscarData(string $traza, string $tipo, string $opcion, string $tienda, array $fecha, string $almacen): void;

  public function encolarDescargaArchivoZip(string $traza, string $almacen, string $ruta_archivo, string $tienda): void;

  public function guardarData(string $path, $data): bool;

  public function tareaSubirData(string $traza, string $tienda, string $almacen): void;

  public function comprimirData(string $carpeta, string $archivo): bool;

  public function descomprimirData(string $rutaArchivoZipLocal, string $carpetaDataDescarga): bool;

  public function subirData(string $ruta_carpeta, string $archivo, string $archivar): bool;

  public function notificarSubidaData(string $uri);

  public function existeArchivoZip(string $archivo_zip, string $archivar): bool;

  public function eliminarArchivoZip(string $archivo_zip, string $archivar): void;

  public function limpiarCarpetaData(string $archivo_zip, string $archivar): void;
  
  public function descargar(string $archivo, string $archivar);
}
