<?php

namespace Epl\Sincronizador\Infrastructure\Eloquent;

use Epl\Sincronizador\Domain\Contracts\SincronizarDataIRepository;
use App\Jobs\Sincronizador\BuscarDataJob;
use App\Jobs\Sincronizador\SubirDataJob;
use Epl\Sincronizador\Domain\Constants\Constant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
    if (!Storage::disk($archivar)->exists($ruta_carpeta)) Storage::disk($archivar)->makeDirectory($ruta_carpeta);

    return Storage::disk($archivar)->putFileAs($ruta_carpeta, storage_path($archivo), 'data.zip');
  }
}
