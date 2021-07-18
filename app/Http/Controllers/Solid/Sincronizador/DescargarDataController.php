<?php

namespace App\Http\Controllers\Solid\Sincronizador;

use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Sincronizador\SolicitarDataResource;
use Epl\Sincronizador\Application\Services\SolicitarExistenciaDataCommand;
use Epl\Sincronizador\Infrastructure\Bus\Contracts\SincronizadorBus;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DescargarDataController extends AppBaseController
{
  /** @var  String */
  private $almacen;
  /** @var  SincronizadorBus */
  private $commandBus;

  public function __construct(SincronizadorBus $commandBus)
  {
    $this->commandBus = $commandBus;
		$this->almacen = Str::lower(config('app.almacen'));
  }
  
  public function solicitar(Request $request)
  {
    try {
      $command = new SolicitarExistenciaDataCommand($this->almacen, $request->tiendas);
  
      $this->commandBus->execute($command);
      
      return $this->sendResponse(
        new SolicitarDataResource(array('message' => __('models/solicitarData.success'))),
        __('messages.success', ['model' => __('models/solicitarData.singular')])
      );
    } catch(\Exception $e) {
      return $this->sendResponse(
        new SolicitarDataResource(array('message' => $e->getMessage())),
        __('messages.failed', ['model' => __('models/solicitarData.singular')])
      );
    }
  }
  
  public function buscar(string $traza, string $tipo, string $opcion, string $tienda, array $fecha)
  {
    $command = new BuscarDataCommand($this->almacen, $traza, $tipo, $opcion, $tienda, $fecha);

    $this->commandBus->execute($command);

    return response()->json('buscar REALIZANDO PRUEBAS');
  }
  
  public function subir(string $traza, string $tienda)
  {
    $command = new SubirDataCommand($this->archivar, $this->almacen, $traza, $tienda);

    $this->commandBus->execute($command);

    return response()->json('subir REALIZANDO PRUEBAS');
  }
}
