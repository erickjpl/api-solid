<?php

namespace Epl\Sincronizador\Infrastructure\Services;

use Epl\Sincronizador\Domain\Contracts\SincronizarDataIRepository;
use App\Jobs\Sincronizador\BuscarDataJob;
use App\Jobs\Sincronizador\SubirDataJob;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

final class SolicitarDataRepository implements SincronizarDataIRepository
{
  public function encolarBuscarData(string $traza, string $tipo, string $opcion, string $tienda, array $fecha, string $almacen): void
  {
    BuscarDataJob::dispatch($traza, $tipo, $opcion, $tienda, $fecha)->onQueue($almacen);
  }

  public function guardarData(string $path, $data): bool
  {
    return Storage::disk('local')->put($path, $data);
  }

  public function tareaSubirData(string $traza, string $tienda, string $almacen): void
  {
    SubirDataJob::dispatch($traza, $tienda)->onQueue($almacen);
  }

  public function comprimirData(string $carpeta, string $archivo): bool
  {
    try {
			$zip = new \ZipArchive();
      
			if ($zip->open(storage_path($archivo), \ZipArchive::CREATE) === TRUE) {
				$files = File::files(storage_path($carpeta));

				foreach ($files as $key => $value) {
					$relativeNameInZipFile = basename($value);
					$zip->addFile($value, $relativeNameInZipFile);
				}

				$zip->close();

				return true;
			}
		} catch (\Exception $e) {
			throw $e;
		}
  }

  public function subirData(string $ruta_carpeta, string $archivo, string $archivar): bool
  {
    if ($archivar == 'local') {
      if (!file_exists($ruta_carpeta)) mkdir($ruta_carpeta);
      
      return file_put_contents("{$ruta_carpeta}/data.zip", storage_path($archivo));
    }

    if (!Storage::disk($archivar)->exists($ruta_carpeta)) Storage::disk($archivar)->makeDirectory($ruta_carpeta);

    return Storage::disk($archivar)->putFileAs($ruta_carpeta, storage_path($archivo), 'data.zip');
  }

  public function notificarSubidaData(string $uri)
  {
    $notificar = config('app.url_notificar');
    $url = "{$notificar}/{$uri}";

    $response = Http::get($url);

    if ($response->successful()) {
      return $response->collect();
    } else {
      return $response->status();
    }
  }

  public function eliminarArchivoZip(string $archivo, string $archivar): void
  {
    if (Storage::disk($archivar)->exists($archivo)) {
			Storage::disk($archivar)->delete($archivo);
    }
  }

  public function limpiarCarpetaData(string $carpeta, string $archivar): void
  {
    if ($archivos = Storage::disk($archivar)->files($carpeta)) {
			Storage::disk($archivar)->delete($archivos);
    }
  }
}
