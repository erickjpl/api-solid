<?php

namespace Epl\Sincronizador\Domain\Services;

use Epl\Sincronizador\Domain\Exceptions\TiendaValleverdeDesconocida;
use Epl\Sincronizador\Domain\Exceptions\OpcionParaSincronizarNoPermitida;
use Epl\Sincronizador\Domain\Exceptions\TipoDeSincronizacionDesconocido;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SolicitarData
{
  private $tiendas;
	private const TODO = 1; /** Todas las opciones */
	private const TODAS = 'all'; /** Todas las opciones */
	private const ESPECIFICA = 2; /** Una opción especifica */
	private const FABRICA = 'fabrica';
	private const NO_PERMITIDA = 'La opción indicada para sincronizar con los almacenes no es permitida favor verifique'; /* 3 */
	private const NO_TIENDA = 'No es una tienda VALLEVERDE favor verifique'; /* 4 */
	private const TIPO_DESCONOCIDO = 'La opción es invalida, para proceder con la sincronización debe verficar el tipo. Valores Permitidos (wholesale, init_web, web, matriz, profit)';

	public function __construct()
	{
		$this->tiendas = Str::of(Str::lower(config('app.almacenes')))->explode(';')->toArray();
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
        Log::error("[SOLICITAR DATA][VALIDAR TIPO][ERROR][".self::NO_PERMITIDA."]");
				throw new TipoDeSincronizacionDesconocido(self::TIPO_DESCONOCIDO);
				break;
		}
  }

  public function devolverFecha(array $fecha = []): array
  {
    $start_date = $fecha['start_date'] ?? now()->addDays(-10);
		$end_date = $fecha['end_date'] ?? now()->addDays(1);
		return array('start_date' => \Carbon\Carbon::parse($start_date)->format('Y-m-d'), 'end_date' => \Carbon\Carbon::parse($end_date)->format('Y-m-d'));
  }

  public function validarTiendaOpciones(string $tipo, string $opcion, string $tienda, array $opciones): int
  {
		if (in_array($tienda, $this->tiendas) || (self::FABRICA == $tipo && self::TODAS == $tienda)) {
			if ($opcion == self::TODAS) { return self::TODO; }
			elseif (in_array($opcion, $opciones)) { return self::ESPECIFICA; }
			else {
				Log::error("[SOLICITAR DATA][VALIDAR OPCIONES][$opcion][ERROR][".self::NO_PERMITIDA."]");
				throw new OpcionParaSincronizarNoPermitida(self::NO_PERMITIDA);
			}
		} else {
			Log::error("[SOLICITAR DATA][VALIDAR OPCIONES][ERROR][".self::NO_TIENDA."]");
			throw new TiendaValleverdeDesconocida(self::NO_TIENDA);
		}
  }
}