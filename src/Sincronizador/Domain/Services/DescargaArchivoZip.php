<?php

namespace Epl\Sincronizador\Domain\Services;

use Epl\Sincronizador\Domain\Constants\Constant;
use Epl\Sincronizador\Domain\Exceptions\TiendaValleverdeDesconocida;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DescargaArchivoZip
{
  public static function archivoZipLocal(string $tienda): string
  {
    return $tienda.'/'.Constant::FILE_DOWN;
  }

  public static function carpetaDataDescarga(string $tienda): string
  {
    return Constant::APP_SYNC.$tienda.'/'.Constant::DOWN_DATA;
  }

  public static function rutaArchivoZipLocal(string $tienda): string
  {
    return Constant::APP_SYNC.$tienda.'/'.Constant::FILE_DOWN;
  }
}