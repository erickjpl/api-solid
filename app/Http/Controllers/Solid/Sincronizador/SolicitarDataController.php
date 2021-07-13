<?php

namespace App\Http\Controllers\Solid\Sincronizador;

use App\Http\Controllers\AppBaseController;
use Epl\Sincronizador\Application\Services\BuscarDataCommand;
use Epl\Sincronizador\Application\Services\SolicitarDataCommand;
use Epl\Sincronizador\Infrastructure\Bus\Contracts\CommandBus;
use Illuminate\Http\Request;

class SolicitarDataController extends AppBaseController
{
  /** @var  CommandBus */
  private $commandBus;

  public function __construct(CommandBus $commandBus)
  {
    $this->commandBus = $commandBus;
  }
  
  public function solicitar(Request $request, $tipo, $opcion, $tienda)
  {
    $command = new SolicitarDataCommand($tipo, $opcion, $tienda, $request->all());

    $this->commandBus->execute($command);

    return response()->json('REALIZANDO PRUEBAS');
  }
  
  public function buscar(string $traza, string $tipo, string $opcion, string $tienda, array $fecha)
  {
    $command = new BuscarDataCommand($traza, $tipo, $opcion, $tienda, $fecha);

    $this->commandBus->execute($command);

    return response()->json('REALIZANDO PRUEBAS');
  }
}
