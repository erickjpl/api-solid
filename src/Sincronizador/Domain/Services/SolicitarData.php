<?php

namespace Epl\Sincronizador\Domain\Services;

class SolicitarData
{
  private const TIENDAS = array('online', 'asambi', 'cande', 'ccct', 'casca', 'hatilo', 'lider', 'recreo', 'retail', 'wholesale', 'matriz');
	private const TODO = 1; /** Todas las opciones */
	private const ESPECIFICA = 2; /** Una opción especifica */
	private const NO_PERMITIDA = 3; /* 'La opción no es permitida favor verifique' */
	private const NO_TIENDA = 4; /* 'No es una tienda VALLEVERDE favor verifique' */

  public function opciones(string $opcion): array
  {
    switch ($opcion) {
			case 'wholesale':
				return array('bancos','clientes', 'colores', 'lin_art', 'cuentas','docum_cc','colores_tallas','sub_lin','vendedor');
			case 'init_web':
				return array('warehouse','bank', 'all-items');
			case 'web':
				return array('categories', 'articles', 'inventories', 'promotions', 'salesmans');
			case 'matriz':
				return array('general', 'warehouse', 'currency', 'categories', 'articles', 'inventories', 'promotions', 'lots', 'tweaks', 'transfers');
			case 'profit':
				return array('customers', 'lots', 'tweaks', 'transfers', 'invoices', 'repayments', 'charges', 'deposits', 'documents');
		}
  }

  public function devolverFecha(array $fecha = []): array
  {
    $start_date = $fecha['start_date'] ?? now()->addDays(-10);
		$end_date = $fecha['end_date'] ?? now()->addDays(1);
		return array('start_date' => \Carbon\Carbon::parse($start_date)->format('Y-m-d'), 'end_date' => \Carbon\Carbon::parse($end_date)->format('Y-m-d'));
  }

  public function validarOpciones(string $opcion, string $tienda, array $opciones): int
  {
    if (in_array($tienda, self::TIENDAS)) {
			if ($opcion == 'all') { return self::TODO; }
      elseif (in_array($opcion, $opciones)) { return self::ESPECIFICA;}
      else { return self::NO_PERMITIDA; } /* 'La opción no es permitida favor verifique' */
		} else { return self::NO_TIENDA; } /* 'No es una tienda VALLEVERDE favor verifique' */
  }
}