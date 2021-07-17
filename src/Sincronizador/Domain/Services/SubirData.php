<?php

namespace Epl\Sincronizador\Domain\Services;

use Epl\Sincronizador\Domain\Constants\Constant;

class SubirData
{
	public static function carpetaData(string $tienda): string
	{
		return Constant::APP_SYNC . $tienda . '/' . Constant::DATA;
	}

	public static function archivoZip(string $tienda): string
	{
		return Constant::APP_SYNC . $tienda . '/' . Constant::DATA_ZIP;
	}

	public static function notificar(string $tienda): array
	{
		if ($tienda == Constant::TIENDA_WEB_DETAL) {				
			$dir_dreamhost = Constant::DIR_DREAMHOST . $tienda;
			$uri = 'api/configuracion/syncronizar/web';
		} elseif ($tienda == 'wholesale') {
			$dir_dreamhost = Constant::DIR_AL_MAYOR;
			$uri = 'al-mayor/Migrate/index2.php';
		} elseif ($this->shop != 'matriz') {
			$dir_dreamhost = Constant::DIR_DREAMHOST . 'matriz/' . $tienda;
			$uri = "api/zip-file-status-on-server/{$this->shop}/matriz/factory/uploaded";
		} else {
			$dir_dreamhost = Constant::DIR_DREAMHOST . $tienda;
			$uri = "api/zip-file-status-on-server/matriz/{$tienda}/store/uploaded";
		}

		return array();
	}
}