<?php

namespace App\Http\Controllers\Solid\Sincronizador;

use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Sincronizador\SolicitarDataResource;
use Epl\Sincronizador\Application\Services\DescargaArchivoZipCommand;
use Epl\Sincronizador\Application\Services\SolicitarExistenciaDataCommand;
use Epl\Sincronizador\Infrastructure\Bus\Contracts\SincronizadorBus;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DescargarDataController extends AppBaseController
{
  /** @var  String */
  private $almacen;
  /** @var  String */
  private $archivar;
  /** @var  SincronizadorBus */
  private $commandBus;

  public function __construct(SincronizadorBus $commandBus)
  {
    $this->commandBus = $commandBus;
		$this->almacen = Str::lower(config('app.almacen'));
		$this->archivar = Str::lower(config('app.archivar'));
  }
  
  public function solicitar(Request $request)
  {
    try {
      $command = new SolicitarExistenciaDataCommand($this->archivar, $this->almacen, $request->tiendas);
  
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
  
  public function buscar(string $traza, string $archivo, string $tienda)
  {
    $command = new DescargaArchivoZipCommand($traza, $this->almacen, $archivo, $tienda, $this->archivar);

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
