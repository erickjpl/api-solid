<?php

namespace App\Jobs\Sincronizador;

use Illuminate\Support\Facades\App;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SubirDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tipo;
    protected $tienda;
    protected $commandBus;

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
    public function __construct(string $traza, string  $tienda,)
    {
        $this->traza = $traza;
        $this->tienda = $tienda;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $sync = App::make(\App\Http\Controllers\Solid\Sincronizador\SolicitarDataController::class);
    
            $sync->subir($this->traza, $this->tienda);
        } catch (\Exception $e) {
            $this->fail($e);
        }
    }
    
    /**
     * Handle a job failure.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(\Throwable $exception)
    {
        Log::error("[BUSCAR DATA JOB][ERROR] {$exception->getMessage()}");
    }
}
