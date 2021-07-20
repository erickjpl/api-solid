<?php

namespace Epl\Sincronizador\Domain\Services;

use Epl\Sincronizador\Domain\Constants\Constant;

class SubirData
{
	public function carpetaData(string $tienda): string
	{
		return Constant::APP_SYNC . $tienda . '/' . Constant::DATA;
	}

	public function archivoZip(string $tienda): string
	{
		return Constant::APP_SYNC . $tienda . '/' . Constant::DATA_ZIP;
	}

	public function notificar(string $archivar, string $tienda, string $almacen): array
	{
		if ($tienda == Constant::TIENDA_WEB_DETAL) {				
			$ruta = Constant::ARCHIVAR == $archivar ? Constant::DIR_DREAMHOST . $tienda : config('app.ruta_archivar') . $tienda;
			$uri = Constant::NOTIFICAR_TIENDA_WEB_DETAL;
		} elseif ($tienda == Constant::TIENDA_WEB_MAYOR) {
			$ruta = Constant::ARCHIVAR == $archivar ? Constant::DIR_AL_MAYOR : config('app.ruta_archivar') . 'mayor';
			$uri = Constant::NOTIFICAR_TIENDA_WEB_MAYOR;
		} elseif ($almacen == Constant::ALMACEN_PRINCIPAL) {
			$ruta = Constant::ARCHIVAR == $archivar ? Constant::DIR_DREAMHOST . $tienda : config('app.ruta_archivar') . $tienda;
			$uri = Constant::NOTIFICAR_ALMACEN."/matriz/{$tienda}/store/uploaded";
		} else {
			$ruta = Constant::ARCHIVAR == $archivar ? Constant::DIR_DREAMHOST.Constant::ALMACEN_PRINCIPAL.'/'.$tienda : config('app.ruta_archivar').Constant::ALMACEN_PRINCIPAL.'/'.$tienda;
			$uri = Constant::NOTIFICAR_ALMACEN."/{$almacen}/matriz/factory/uploaded";
		}

		return array('ruta' => $ruta, 'uri' => $uri);
	}
}