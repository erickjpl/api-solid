<?php

namespace Epl\Sincronizador\Application\Handlers;

use Epl\Sincronizador\Domain\Contracts\SincronizarDataIRepository;
use Epl\Sincronizador\Application\Contracts\Handler;
use Epl\Sincronizador\Domain\Services\SolicitarData;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class SolicitarDataHandler implements Handler
{
	private $almacen;
	private $repository;

	public function __construct(SincronizarDataIRepository $repository)
	{
		$this->almacen = Str::lower(config('app.almacen'));
		$this->repository = $repository;
	}

	public function __invoke($command)
	{
		$service = new SolicitarData();
		$opciones = $service->validarTipo($command->getTipo());
		$fecha = $service->devolverFecha($command->getFecha());
		$flag = $service->validarTiendaOpciones($command->getTipo(), $command->getOpcion(), $command->getTienda(), $opciones, $this->almacen);
		
		$this->encolar($flag, $command->getTipo(), $command->getOpcion(), $command->getTienda(), $opciones, $fecha);
	}

	private function encolar(int $flag, string $tipo, string $opcion, string $tienda, array $opciones, array $fecha)
	{
		switch ($flag) {
			case 1:
				foreach ($opciones as $value) {
					$traza = $this->encolarBuscarData($tipo, $value, $tienda, $fecha);
					Log::debug("[$traza][PROFIT][ALMACEN]{$this->almacen}[DESTINO]{$tienda} | [TIPO] {$tipo} [OPCION] {$value} | [FECHA] {$fecha['start_date']} - {$fecha['end_date']}");
				}
				break;
			case 2:
				$traza = $this->encolarBuscarData($tipo, $opcion, $tienda, $fecha);
        Log::debug("[$traza][PROFIT][ALMACEN]{$this->almacen}[DESTINO]{$tienda} | [TIPO] {$tipo} [OPCION] {$opcion} | [FECHA] {$fecha['start_date']} - {$fecha['end_date']}");
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
