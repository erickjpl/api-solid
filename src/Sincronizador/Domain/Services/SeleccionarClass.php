<?php

namespace Epl\Sincronizador\Domain\Services;

use Epl\Sincronizador\Domain\Events\BuscarClassDataProfit;
use Epl\Sincronizador\Domain\Events\BuscarClassDataWebDetal;
use Epl\Sincronizador\Domain\Events\BuscarClassDataWebMayor;

class SeleccionarClass
{
  public static function opcionBuscar(string $tienda)
	{
		switch ($tienda) {
			case 'retail':
				return new BuscarClassDataWebDetal();
				break;
			case 'wholesale':
				return new BuscarClassDataWebMayor();
				break;
			default:
				return new BuscarClassDataProfit();
				break;
		}
	}
}