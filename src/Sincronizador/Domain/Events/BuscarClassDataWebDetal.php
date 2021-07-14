<?php

namespace Epl\Sincronizador\Domain\Events;

use Epl\Sincronizador\Domain\Contracts\BuscarClassInterface;

final class BuscarClassDataWebDetal implements BuscarClassInterface
{
  public function obtenerClass(string $traza, string $opcion, string $tienda, array $fecha): array
  {
    # $this->searchDataProfit($traza, $opcion, $tienda, $fecha);
    return [];
  }
}
