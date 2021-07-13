<?php

namespace Epl\Sincronizador\Domain\Events;

use Epl\Sincronizador\Domain\Contracts\SincronizarDataIRepository;

final class BuscarDataWebMayor implements SincronizarDataIRepository
{
  public function encolarBuscarData(string $traza, string $tipo, string $opcion, string $tienda, array $fecha, string $almacen): void
  {

  }
  
  public function buscarData(string $traza, string $opcion, string $tienda, array $fecha): array
  {
    # $this->searchDataProfit($traza, $opcion, $tienda, $fecha);
    return [];
  }
}
