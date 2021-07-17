<?php

namespace Epl\Sincronizador\Domain\Services;

use Epl\Sincronizador\Domain\Events\BuscarClassDataProfit;
use Epl\Sincronizador\Domain\Events\BuscarClassDataWebDetal;
use Epl\Sincronizador\Domain\Events\BuscarClassDataWebMayor;

class SeleccionarClass
{
	const TODAS_TIENDAS = 'all';
	const TIPO_ESPECIAL = array('matriz', 'profit');
	const EXCLUIR_TIENDAS = array('matriz', 'online', 'retail', 'wholesale');

	public static function ejecutarTodasTiendas(string $opcion): bool
	{
		return $opcion == self::TODAS_TIENDAS;
	}

	public static function validarTipoEspecial(string $tipo): bool
	{
		return in_array($tipo, self::TIPO_ESPECIAL);
	}

	public static function excluirTiendas(string $tienda): bool
	{
		return in_array($tienda, self::EXCLUIR_TIENDAS);
	}

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