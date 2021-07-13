<?php

namespace Epl\Sincronizador\Domain\Services;

use Epl\Sincronizador\Domain\Contracts\BuscarDataAbstract;
use Epl\Sincronizador\Domain\Contracts\SincronizarDataIRepository;
use Epl\Sincronizador\Domain\Events\BuscarDataProfit;
use Epl\Sincronizador\Domain\Events\BuscarDataWebDetal;
use Epl\Sincronizador\Domain\Events\BuscarDataWebMayor;

class SeleccionarClass
{
	private $interface;

	public function __construct(SincronizarDataIRepository $interface)
	{
		$this->$interface = $interface;
	}

  public function opcionBuscar(string $tienda): BuscarDataAbstract
	{
		switch ($tienda) {
			case 'retail':
				return new BuscarDataWebDetal();
				break;
			case 'wholesale':
				return new BuscarDataWebMayor();
				break;
			default:
				return new BuscarDataProfit($this->interface);
				break;
		}
	}
}