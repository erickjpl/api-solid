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
			$uri = 'api/configuracion/syncronizar/web';
		} elseif ($tienda == Constant::TIENDA_WEB_MAYOR) {
			$ruta = Constant::ARCHIVAR == $archivar ? Constant::DIR_AL_MAYOR : config('app.ruta_archivar') . 'mayor';
			$uri = 'al-mayor/Migrate/index2.php';
		} elseif ($almacen == Constant::ALMACEN_PRINCIPAL) {
			$ruta = Constant::ARCHIVAR == $archivar ? Constant::DIR_DREAMHOST . $tienda : config('app.ruta_archivar') . $tienda;
			$uri = "api/zip-file-status-on-server/matriz/{$tienda}/store/uploaded";
		} else {
			$ruta = Constant::ARCHIVAR == $archivar ? Constant::DIR_DREAMHOST . 'matriz/' . $tienda : config('app.ruta_archivar') . 'matriz/' . $tienda;
			$uri = "api/zip-file-status-on-server/{$almacen}/matriz/factory/uploaded";
		}

		return array('ruta' => $ruta, 'uri' => $uri);
	}
}