<?php

namespace Epl\Sincronizador\Infrastructure\Eloquent;

use App\Jobs\Sincronizador\BuscarDataJob;
use Epl\Sincronizador\Domain\Contracts\SincronizarDataIRepository;
use Illuminate\Support\Facades\Storage;

final class SolicitarDataRepository implements SincronizarDataIRepository
{
  public function encolarBuscarData(string $traza, string $tipo, string $opcion, string $tienda, array $fecha, string $almacen): void
  {
    BuscarDataJob::dispatch($traza, $tipo, $opcion, $tienda, $fecha)->onQueue($almacen);
  }

  public function guardarData(string $path, string $data): bool
  {
    return Storage::disk('local')->put($path, $data);
  }
}
