<?php

namespace Epl\Sincronizador\Application\Services;

use Epl\Sincronizador\Application\Contracts\Handler;
use Epl\Sincronizador\Domain\Contracts\SolicitarDataIRepository;
use Epl\Sincronizador\Domain\Services\SolicitarData;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class SolicitarDataHandler implements Handler
{
	private $almacen;
	private $repository;

	public function __construct(SolicitarDataIRepository $repository)
	{
		$this->repository = $repository;
		$this->almacen = Str::lower(config('app.shop'));
	}

	public function __invoke($command)
	{
		$service = new SolicitarData();
		$opciones = $service->opciones($command->getOpcion());
		$fecha = $service->devolverFecha($command->getFecha());
		$flag = $service->validarOpciones($command->getOpcion(), $command->getTienda(), $opciones);

		$this->encolar($flag, $command->getTipo(), $command->getOpcion(), $command->getTienda(), $opciones, $fecha);
	}

	private function encolar(int $flag, string $tipo, string $opcion, string $tienda, array $opciones, array $fecha)
	{
		switch ($flag) {
			case 1:
				foreach ($opciones as $value) {
					$traza = $this->encolarBuscarData($tipo, $value, $tienda, $fecha);
					Log::info("[$traza][PROFIT][ALMACEN]{$this->almacen}[DESTINO]{$tienda} | [TIPO] {$tipo} [OPCION] {$value} | [FECHA] {$fecha['start_date']} - {$fecha['end_date']}");
				}
				break;
			case 2:
				$traza = $this->encolarBuscarData($tipo, $opcion, $tienda, $fecha);
        Log::info("[$traza][PROFIT][ALMACEN]{$this->almacen}[DESTINO]{$tienda} | [TIPO] {$tipo} [OPCION] {$opcion} | [FECHA] {$fecha['start_date']} - {$fecha['end_date']}");
				break;
			case 3:
        Log::error("[PROFIT][ALMACEN]{$this->almacen}[DESTINO]{$tienda} | [TIPO] {$tipo} [OPCION] La opción enviada no es permitida.");
				break;
			case 4:
				Log::error("[PROFIT][ALMACEN]{$this->almacen}[DESTINO]{$tienda} | [TIPO] {$tipo} La tienda enviada no es filial de VALLEVERDE");
				break;
			
			default:
				Log::error("[PROFIT] Error no esperando");
				break;
		}
	}

  private function encolarBuscarData(string $tipo, string $opcion, string $tienda, array $fecha)
  {
    $traza = Str::random(6);
    $this->repository->encolarBuscarData($traza, $tipo, $opcion, $tienda, $fecha, $this->almacen);
    return $traza;
  }
}
