<?php

namespace Epl\Sincronizador\Infrastructure\Eloquent;

use App\Jobs\Sincronizador\BuscarDataJob;
use Epl\Sincronizador\Domain\Contracts\SolicitarDataIRepository;

final class SolicitarDataRepository implements SolicitarDataIRepository
{
  public function encolarBuscarData(string $traza, string $tipo, string $opcion, string $tienda, array $fecha, string $almacen): void
  {
    BuscarDataJob::dispatch($traza, $tipo, $opcion, $tienda, $fecha)->onQueue($almacen);
  }
}
