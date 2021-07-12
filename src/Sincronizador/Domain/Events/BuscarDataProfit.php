<?php

namespace Epl\Sincronizador\Domain\Events;

use Epl\Sincronizador\Domain\Constants\Constant;
use Epl\Sincronizador\Domain\Contracts\BuscarDataInterface;

final class BuscarDataProfit extends Constant implements BuscarDataInterface
{
  public function buscarData(string $traza, string $opcion, string $tienda, array $fecha): array
  {
		switch ($opcion) {
			case 'general':
				return array(
					array('class' => \App\Models\Sincronizador\Vendedor::class, 'path' => $tienda.'/'.self::DATA.self::VENDEDOR, 'query' => array('condic' => 1)),
					array('class' => \App\Models\Sincronizador\TipoAju::class, 'path' =>  $tienda.'/'.self::DATA.self::TIPO_AJU, 'query' => false),
					array('class' => \App\Models\Sincronizador\CtaIngr::class, 'path' =>  $tienda.'/'.self::DATA.self::CTA_INGR, 'query' => false),
					array('class' => \App\Models\Sincronizador\Segmento::class, 'path' =>  $tienda.'/'.self::DATA.self::SEGMENTO, 'query' => false),
					array('class' => \App\Models\Sincronizador\TipoPro::class, 'path' =>  $tienda.'/'.self::DATA.self::TIPO_PRO, 'query' => false),
					array('class' => \App\Models\Sincronizador\Zona::class, 'path' =>  $tienda.'/'.self::DATA.self::ZONA, 'query' => false),
					array('class' => \App\Models\Sincronizador\Prov::class, 'path' =>  $tienda.'/'.self::DATA.self::PROV, 'query' => false),
					array('class' => \App\Models\Sincronizador\Tabulado::class, 'path' =>  $tienda.'/'.self::DATA.self::TABULADO, 'query' => false),
					array('class' => \App\Models\Sincronizador\Unidades::class, 'path' =>  $tienda.'/'.self::DATA.self::UNIDADES, 'query' => false),
					array('class' => \App\Models\Sincronizador\Proceden::class, 'path' =>  $tienda.'/'.self::DATA.self::PROCEDEN, 'query' => false),
					array('class' => \App\Models\Sincronizador\TipoCli::class, 'path' =>  $tienda.'/'.self::DATA.self::TIPO_CLI, 'query' => false)
				);
				break;
			// case 'warehouse':
			// 	$this->almacen($fecha,$tienda); # se guardan las sucursales
			// 	$this->sub_alma($fecha,$tienda);  # se guardan los almacenes
			// 	break;
			// case 'currency':
			// 	$this->moneda($fecha,$tienda);
			// 	$this->tasas($fecha,$tienda);
			// 	break;
			// case 'customers':
			// 	$this->vendedor($fecha,$tienda);
			// 	$this->clientes($fecha,$tienda);
			// 	break;			
			// case 'categories':
			// 	$this->lin_art($fecha,$tienda);
			// 	$this->sub_lin($fecha,$tienda);
			// 	$this->colores($fecha,$tienda);
			// 	$this->cat_art($fecha,$tienda);
			// 	break;
			// case 'articles':
			// 	$this->art($fecha,$tienda);
			// 	break;
			// case 'inventories':
			// 	$this->lote($fecha,$tienda);
			// 	break;
			// case 'promotions':
			// 	$this->descuen($fecha,$tienda);
			// 	break;
			// case 'lots':
			// 	$this->st_almac($fecha,$tienda);
			// 	$this->st_lote($fecha,$tienda);
			// 	break;
			// case 'tweaks':
			// 	$this->ajuste($fecha,$tienda);
			// 	$this->reng_aju($fecha,$tienda);
			// 	break;
			// case 'transfers':
			// 	$this->tras_alm($fecha,$tienda);
			// 	$this->reng_tra($fecha,$tienda);
			// 	break;
			// case 'invoices':
			// 	$this->factura($fecha,$tienda);
			// 	$this->reng_fac($fecha,$tienda);
			// 	break;
			// case 'repayments':
			// 	$this->dev_cli($fecha,$tienda);
			// 	$this->reng_dvc($fecha,$tienda);
			// 	break;
			// case 'charges':
			// 	$this->cobros($fecha,$tienda);
			// 	$this->reng_cob($fecha,$tienda);
			// 	$this->reng_tip($fecha,$tienda);
			// 	break;
			// case 'deposits':
			// 	$this->cajas($fecha,$tienda);
			// 	$this->cuentas($fecha,$tienda);
			// 	$this->dep_caj($fecha,$tienda);
			// 	$this->reng_dp($fecha,$tienda);
			// 	$this->mov_caj($fecha,$tienda);
			// 	$this->mov_ban($fecha,$tienda);
			// 	break;
			// case 'documents':
			// 	$this->docum_cc($fecha,$tienda);
			// 	break;
		}
  }
}
