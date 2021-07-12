<?php

namespace Epl\Sincronizador\Domain\Services;

use Epl\Sincronizador\Domain\Contracts\BuscarDataInterface;
use Epl\Sincronizador\Domain\Events\BuscarDataProfit;
use Epl\Sincronizador\Domain\Events\BuscarDataWebDetal;
use Epl\Sincronizador\Domain\Events\BuscarDataWebMayor;

class BuscarData
{
  public function opcionBuscar(string $tienda): BuscarDataInterface
	{
		switch ($tienda) {
			case 'retail':
				return new BuscarDataWebDetal();
				break;
			case 'wholesale':
				return new BuscarDataWebMayor();
				break;
			default:
				return new BuscarDataProfit();
				break;
		}
	}
}