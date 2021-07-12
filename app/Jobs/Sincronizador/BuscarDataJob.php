<?php

namespace App\Jobs\Sincronizador;

use Epl\Sincronizador\Infrastructure\Bus\Contracts\CommandBus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BuscarDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tipo;
    protected $fecha;
    protected $traza;
    protected $opcion;
    protected $tienda;
    protected CommandBus $commandBus;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 2;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 240;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($traza, $tipo, $opcion, $tienda, $fecha)
    {
        $this->tipo = $tipo;
        $this->fecha = $fecha;
        $this->traza = $traza;
        $this->tienda = $tienda;
        $this->opcion = $opcion;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sync = new \App\Http\Controllers\Sincronizador\SolicitarDataController($this->commandBus);

        $sync->buscar($this->traza, $this->tipo, $this->opcion, $this->tienda, $this->fecha);
    }
}
