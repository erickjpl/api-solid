<?php

namespace Epl\Sincronizador\Domain\Services;

use Epl\Sincronizador\Domain\Constants\Constant;
use Epl\Sincronizador\Domain\Events\BuscarClassDataProfit;
use Epl\Sincronizador\Domain\Events\BuscarClassDataWebDetal;
use Epl\Sincronizador\Domain\Events\BuscarClassDataWebMayor;

class SeleccionarClass
{
	public static function ejecutarTodasTiendas(string $opcion): bool
	{
		return $opcion == Constant::TODAS_TIENDAS;
	}

	public static function validarTipoEspecial(string $tipo, string $almacen): bool
	{
		return in_array($tipo, Constant::TIPO_ESPECIAL) && in_array($almacen, Constant::TIPO_ESPECIAL);
	}

	public static function excluirTiendas(string $tienda): bool
	{
		return in_array($tienda, Constant::EXCLUIR_TIENDAS);
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