<?php

namespace Epl\Sincronizador\Infrastructure\Services;

use Epl\Sincronizador\Domain\Contracts\SincronizarDataIRepository;
use App\Jobs\Sincronizador\BuscarDataJob;
use App\Jobs\Sincronizador\DescargaArchivoZipJob;
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

  public function encolarDescargaArchivoZip(string $traza, string $almacen, string $ruta_archivo, string $tienda): void
  {
    DescargaArchivoZipJob::dispatch($traza, $ruta_archivo, $tienda)->onQueue($almacen);
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

  public function descomprimirData(string $rutaArchivoZipLocal, string $carpetaDataDescarga): bool
  {
    try {
        $zip = new \ZipArchive();

      if ($zip->open(storage_path($rutaArchivoZipLocal)) === TRUE) {
        $zip->extractTo(storage_path($carpetaDataDescarga));
        $zip->close();

				return true;
      }

      return false;
    } catch (\Exception $e) {
			throw $e;
		}
  }

  public function subirData(string $ruta_carpeta, string $archivo, string $archivar): bool
  {
    if ($archivar == 'local') {
      if (!$this->existeArchivoZip($ruta_carpeta, $archivar)) mkdir($ruta_carpeta);
      
      return file_put_contents("{$ruta_carpeta}/data.zip", storage_path($archivo));
    }

    if (!$this->existeArchivoZip($ruta_carpeta, $archivar)) Storage::disk($archivar)->makeDirectory($ruta_carpeta);

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

  public function existeArchivoZip(string $archivo, string $archivar): bool
  {
    if ($archivar == 'local') { // Archiva en modo Pruebas
      return file_exists($archivo);
    }

    /** Archivar vía FTP */
    return Storage::disk($archivar)->exists($archivo);
  }

  public function eliminarArchivoZip(string $archivo, string $archivar): void
  {
    if ($archivar == 'local') { // Descargar archivo en modo Pruebas
      unlink($archivo);
    }

    Storage::disk($archivar)->delete($archivo);
  }

  public function limpiarCarpetaData(string $carpeta, string $archivar): void
  {
    if ($archivos = Storage::disk($archivar)->files($carpeta)) {
			Storage::disk($archivar)->delete($archivos);
    }
  }

  public function descargar(string $archivo, string $archivar)
  {
    if ($archivar == 'local') { // Descargar archivo en modo Pruebas
      return file_get_contents($archivo);
    }

    return Storage::disk($archivar)->get($archivo);
  }
}
