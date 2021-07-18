<?php

namespace Epl\Sincronizador\Domain\Events;

use Epl\Sincronizador\Domain\Constants\Constant;
use Epl\Sincronizador\Domain\Contracts\BuscarClassInterface;

final class BuscarClassDataProfit implements BuscarClassInterface
{ 
  public function obtenerClass(string $traza, string $opcion, string $tienda, array $fecha): array
  {
		switch ($opcion) {
			case 'general':
				return array(
					array('traza' => $traza, 'class' => 'Vendedor', 'path' => Constant::SYNC.'/'.$tienda.'/'.Constant::DATA.Constant::VENDEDOR, 'query' => array('condic' => 1)),
					array('traza' => $traza, 'class' => 'TipoAju', 'path' =>  Constant::SYNC.'/'.$tienda.'/'.Constant::DATA.Constant::TIPO_AJU, 'query' => []),
					array('traza' => $traza, 'class' => 'CtaIngr', 'path' =>  Constant::SYNC.'/'.$tienda.'/'.Constant::DATA.Constant::CTA_INGR, 'query' => array('fe_us_mo' => array($fecha['start_date'],$fecha['end_date']))),
					array('traza' => $traza, 'class' => 'Segmento', 'path' =>  Constant::SYNC.'/'.$tienda.'/'.Constant::DATA.Constant::SEGMENTO, 'query' => array('fe_us_mo' => array($fecha['start_date'],$fecha['end_date']))),
					array('traza' => $traza, 'class' => 'TipoPro', 'path' =>  Constant::SYNC.'/'.$tienda.'/'.Constant::DATA.Constant::TIPO_PRO, 'query' => array('fe_us_mo' => array($fecha['start_date'],$fecha['end_date']))),
					array('traza' => $traza, 'class' => 'Zona', 'path' =>  Constant::SYNC.'/'.$tienda.'/'.Constant::DATA.Constant::ZONA, 'query' => array('fe_us_mo' => array($fecha['start_date'],$fecha['end_date']))),
					array('traza' => $traza, 'class' => 'Prov', 'path' =>  Constant::SYNC.'/'.$tienda.'/'.Constant::DATA.Constant::PROV, 'query' => array('fe_us_mo' => array($fecha['start_date'],$fecha['end_date']))),
					array('traza' => $traza, 'class' => 'Tabulado', 'path' =>  Constant::SYNC.'/'.$tienda.'/'.Constant::DATA.Constant::TABULADO, 'query' => []),
					array('traza' => $traza, 'class' => 'Unidades', 'path' =>  Constant::SYNC.'/'.$tienda.'/'.Constant::DATA.Constant::UNIDADES, 'query' => array('fe_us_mo' => array($fecha['start_date'],$fecha['end_date']))),
					array('traza' => $traza, 'class' => 'Proceden', 'path' =>  Constant::SYNC.'/'.$tienda.'/'.Constant::DATA.Constant::PROCEDEN, 'query' => array('fe_us_mo' => array($fecha['start_date'],$fecha['end_date']))),
					array('traza' => $traza, 'class' => 'TipoCli', 'path' =>  Constant::SYNC.'/'.$tienda.'/'.Constant::DATA.Constant::TIPO_CLI, 'query' => array('fe_us_mo' => array($fecha['start_date'],$fecha['end_date'])))
				);
				break;
			case 'almacenes':
				return array(
					// array('traza' => $traza, 'class' => 'Almacen', 'path' => Constant::SYNC.'/'.$tienda.'/'.Constant::DATA.Constant::ALMACEN, 'query' => array('between' => array('fe_us_mo' => array($fecha['start_date'],$fecha['end_date'])), 'co_sucu' => $tienda)),
					// array('traza' => $traza, 'class' => 'SubAlma', 'path' => Constant::SYNC.'/'.$tienda.'/'.Constant::DATA.Constant::SUB_ALMA, 'query' => array('between' => array('fe_us_mo' => array($fecha['start_date'],$fecha['end_date'])), 'co_sucu' => $tienda))
				);
				break;
			// case 'tasas':
			// 	$this->moneda($fecha,$tienda);
			// 	$this->tasas($fecha,$tienda);
			// 	break;
			// case 'clientes':
			// 	$this->vendedor($fecha,$tienda);
			// 	$this->clientes($fecha,$tienda);
			// 	break;			
			// case 'categorias':
			// 	$this->lin_art($fecha,$tienda);
			// 	$this->sub_lin($fecha,$tienda);
			// 	$this->colores($fecha,$tienda);
			// 	$this->cat_art($fecha,$tienda);
			// 	break;
			// case 'articulos':
			// 	$this->art($fecha,$tienda);
			// 	break;
			// case 'inventarios':
			// 	$this->lote($fecha,$tienda);
			// 	break;
			// case 'descuentos':
			// 	$this->descuen($fecha,$tienda);
			// 	break;
			// case 'lotes':
			// 	$this->st_almac($fecha,$tienda);
			// 	$this->st_lote($fecha,$tienda);
			// 	break;
			// case 'ajustes':
			// 	$this->ajuste($fecha,$tienda);
			// 	$this->reng_aju($fecha,$tienda);
			// 	break;
			// case 'traslados':
			// 	$this->tras_alm($fecha,$tienda);
			// 	$this->reng_tra($fecha,$tienda);
			// 	$this->lote($fecha,$tienda);
			// 	$this->st_alma($fecha,$tienda);
			// 	$this->st_lote($fecha,$tienda);
			// 	break;
			// case 'facturas':
			// 	$this->factura($fecha,$tienda);
			// 	$this->reng_fac($fecha,$tienda);
			// 	break;
			// case 'devoluciones':
			// 	$this->dev_cli($fecha,$tienda);
			// 	$this->reng_dvc($fecha,$tienda);
			// 	break;
			// case 'cobros':
			// 	$this->cobros($fecha,$tienda);
			// 	$this->reng_cob($fecha,$tienda);
			// 	$this->reng_tip($fecha,$tienda);
			// 	break;
			// case 'depositos':
			// 	$this->cajas($fecha,$tienda);
			// 	$this->cuentas($fecha,$tienda);
			// 	$this->dep_caj($fecha,$tienda);
			// 	$this->reng_dp($fecha,$tienda);
			// 	$this->mov_caj($fecha,$tienda);
			// 	$this->mov_ban($fecha,$tienda);
			// 	break;
			// case 'documentos':
			// 	$this->docum_cc($fecha,$tienda);
			// 	break;
		}
  }
}
