<?php

namespace Epl\Sincronizador\Infrastructure\Eloquent;

use Epl\Sincronizador\Domain\Contracts\SincronizarDataIRepository;
use App\Jobs\Sincronizador\BuscarDataJob;
use App\Jobs\Sincronizador\SubirDataJob;
use Illuminate\Support\Facades\Storage;

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

  public function subirData(string $traza, string $tienda, string $almacen): void
  {
    SubirDataJob::dispatch($traza, $tienda)->onQueue($almacen);
  }
}
