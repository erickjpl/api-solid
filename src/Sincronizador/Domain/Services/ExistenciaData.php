<?php

namespace Epl\Sincronizador\Domain\Services;

use Epl\Sincronizador\Domain\Constants\Constant;
use Epl\Sincronizador\Domain\Exceptions\TiendaValleverdeDesconocida;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ExistenciaData
{
	private $flag;
	private $tiendas;

	public function __construct()
	{
		$almacenes = Str::of(Str::lower(config('app.almacenes')))->explode(';')->toArray();
		$this->tiendas = array_diff($almacenes, Constant::EXCLUIR_TIENDAS);
	}

	/**
	 * @param string $archivar
	 * @param array|string|null $payload
	 * @param string $almacen
	 */
  public function validarTiendas(string $archivar, $payload, string $almacen): array
  {
		$this->flag = $this->archivador($archivar);

		/** Si el almacen solicitado esta vacio y es diferente al principal  */
		if (is_null($payload) && $almacen != Constant::ALMACEN_PRINCIPAL) {
			return array($almacen => $this->flag ? Constant::DIR_DREAMHOST.$almacen : config('app.ruta_archivar').$almacen);
		}

		/** El almacen es el principal */
		if ($almacen == Constant::ALMACEN_PRINCIPAL) {
			if (is_null($payload) || $payload == Constant::TODAS) { return $this->verificarTiendas($this->tiendas); }
			elseif (is_array($payload)) { return $this->verificarTiendas($payload); }
			elseif (str_contains($payload, ',')) { return $this->verificarTiendas(explode(",", $payload)); }
			elseif (in_array($payload, $this->tiendas)) {
				return array($payload =>  $this->flag ? Constant::DIR_DREAMHOST.Constant::ALMACEN_PRINCIPAL.'/'.$payload : config('app.ruta_archivar').Constant::ALMACEN_PRINCIPAL.'/'.$payload);
			}
		}

		Log::error("[EXISTENCIA DATA][VALIDAR TIENDAS][ERROR][".Constant::NO_TIENDA."]");
		throw new TiendaValleverdeDesconocida(Constant::NO_TIENDA);
  }

	private function archivador(string $archivar): bool
	{
		return Constant::ARCHIVAR == $archivar;
	}

	private function verificarTiendas(array $payload): array
	{
		$tiendas = collect();
		foreach ($payload as $tienda) {
			if (in_array($tienda, $this->tiendas)) {
				$path = $this->flag ? Constant::DIR_DREAMHOST.Constant::ALMACEN_PRINCIPAL.'/'.$tienda : config('app.ruta_archivar').Constant::ALMACEN_PRINCIPAL.'/'.$tienda;

				$tiendas->put($tienda, $path);
			}
		}

		return $tiendas->all();
	}
}