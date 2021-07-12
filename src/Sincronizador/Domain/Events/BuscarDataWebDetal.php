<?php

namespace Epl\Sincronizador\Domain\Events;

use Epl\Sincronizador\Domain\Contracts\BuscarDataInterface;

final class BuscarDataWebDetal implements BuscarDataInterface
{
  public function buscarData(string $traza, string $opcion, string $tienda, array $fecha): array
  {
    $this->searchDataProfit($traza, $opcion, $tienda, $fecha);
  }
}
