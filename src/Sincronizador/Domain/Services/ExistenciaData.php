<?php

namespace Epl\Sincronizador\Domain\Services;

use Epl\Sincronizador\Domain\Constants\Constant;
use Epl\Sincronizador\Domain\Exceptions\TiendaValleverdeDesconocida;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ExistenciaData
{
	private $tiendas;

	public function __construct()
	{
		$almacenes = Str::of(Str::lower(config('app.almacenes')))->explode(';')->toArray();
		$this->tiendas = array_diff($almacenes, Constant::EXCLUIR_TIENDAS);
	}

  public function validarTiendas(string $payload, string $almacen): mixed
  {
		if (is_null($payload)) { return $almacen; }

		if ($almacen == Constant::ALMACEN_PRINCIPAL) {
			if ($payload == Constant::TODAS) { return $this->tiendas; }
			elseif (str_contains($payload, ',')) { return explode(",", $payload); }
			else { return $payload; }
		}

		if (in_array($payload, $this->tiendas)) { return $payload; }
		else {
			Log::error("[EXISTENCIA DATA][VALIDAR TIENDAS][ERROR][".Constant::NO_TIENDA."]");
			throw new TiendaValleverdeDesconocida(Constant::NO_TIENDA);
		}	
  }

	public function existeArchivoParaDescargar(mixed $payload)
	{
		if (is_array($payload)) {
			
		}
	}
}