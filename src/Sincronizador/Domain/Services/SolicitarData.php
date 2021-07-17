<?php

namespace Epl\Sincronizador\Domain\Services;

use Epl\Sincronizador\Domain\Constants\Constant;
use Epl\Sincronizador\Domain\Exceptions\TiendaValleverdeDesconocida;
use Epl\Sincronizador\Domain\Exceptions\OpcionParaSincronizarNoPermitida;
use Epl\Sincronizador\Domain\Exceptions\TipoDeSincronizacionDesconocido;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SolicitarData
{
  private $tiendas;

	public function __construct()
	{
		$almacenes = Str::of(Str::lower(config('app.almacenes')))->explode(';')->toArray();
		$this->tiendas = array_diff($almacenes, Constant::EXCLUIR_TIENDAS);
	}

  public function devolverFecha(array $fecha = []): array
  {
    $start_date = $fecha['start_date'] ?? now()->addDays(-10);
		$end_date = $fecha['end_date'] ?? now()->addDays(1);
		return array('start_date' => \Carbon\Carbon::parse($start_date)->format('Y-m-d'), 'end_date' => \Carbon\Carbon::parse($end_date)->format('Y-m-d'));
  }

  public function validarTipo(string $tipo): array
  {
    switch ($tipo) {
			case 'web-mayor':
				return array('bancos','clientes', 'colores', 'lin_art', 'cuentas','docum_cc','colores_tallas','sub_lin','vendedor');
			case 'init_web':
				return array('warehouse','bank', 'all-items');
			case 'web-detal':
				return array('categories', 'articles', 'inventories', 'promotions', 'salesmans');
			case 'fabrica': // matriz
				return array('general', 'warehouse', 'currency', 'categories', 'articles', 'inventories', 'promotions', 'lots', 'tweaks', 'transfers');
			case 'profit':
				return array('customers', 'lots', 'tweaks', 'transfers', 'invoices', 'repayments', 'charges', 'deposits', 'documents');
			default:
        Log::error("[SOLICITAR DATA][VALIDAR TIPO][ERROR][".Constant::NO_PERMITIDA."]");
				throw new TipoDeSincronizacionDesconocido(Constant::TIPO_DESCONOCIDO);
				break;
		}
  }

  public function validarTienda(string $tienda, string $tipo)
	{
		if (in_array($tienda, $this->tiendas)) { return $tienda; }

		if ($tienda == Constant::TODAS && $tipo == Constant::FABRICA) { return $this->tiendas; }

		Log::error("[SOLICITAR DATA][VALIDAR TIENDA][ERROR][".Constant::NO_TIENDA."]");
		throw new TiendaValleverdeDesconocida(Constant::NO_TIENDA);
	}

  public function validarOpciones(string $opcion, array $opciones): int
  {
		if ($opcion == Constant::TODAS) { return Constant::TODO; }
		elseif (in_array($opcion, $opciones)) { return Constant::ESPECIFICA; }
		else {
			Log::error("[SOLICITAR DATA][VALIDAR OPCIONES][$opcion][ERROR][".Constant::NO_PERMITIDA."]");
			throw new OpcionParaSincronizarNoPermitida(Constant::NO_PERMITIDA);
		}
  }
}