<?php

namespace App\Providers;

use Epl\Sincronizador\Infrastructure\Bus\SincronizadorCommandBus;
use Epl\Sincronizador\Infrastructure\Bus\Contracts\SincronizadorBus;

use Epl\Sincronizador\Infrastructure\Bus\LaravelContainer;
use Epl\Sincronizador\Application\Bus\Contracts\Container;

use Epl\Sincronizador\Domain\Contracts\SincronizarDataIRepository;
use Epl\Sincronizador\Infrastructure\Services\SolicitarDataRepository;

use Epl\Sincronizador\Domain\Contracts\InterfaceRespository;

use Epl\Sincronizador\Infrastructure\Eloquent\ConnectionRepository;


use Epl\Sincronizador\Application\Handlers\Profit\CasoUsoCtaIngr;
use Epl\Sincronizador\Application\Handlers\Profit\CasoUsoProceden;
use Epl\Sincronizador\Application\Handlers\Profit\CasoUsoProv;
use Epl\Sincronizador\Application\Handlers\Profit\CasoUsoSegmento;
use Epl\Sincronizador\Application\Handlers\Profit\CasoUsoTabulado;
use Epl\Sincronizador\Application\Handlers\Profit\CasoUsoTipoAju;
use Epl\Sincronizador\Application\Handlers\Profit\CasoUsoTipoCli;
use Epl\Sincronizador\Application\Handlers\Profit\CasoUsoTipoPro;
use Epl\Sincronizador\Application\Handlers\Profit\CasoUsoUnidades;
use Epl\Sincronizador\Application\Handlers\Profit\CasoUsoVendedor;
use Epl\Sincronizador\Application\Handlers\Profit\CasoUsoZona;

use Epl\Sincronizador\Infrastructure\Eloquent\CtaIngrRepository;
use Epl\Sincronizador\Infrastructure\Eloquent\ProcedenRepository;
use Epl\Sincronizador\Infrastructure\Eloquent\ProvRepository;
use Epl\Sincronizador\Infrastructure\Eloquent\SegmentoRepository;
use Epl\Sincronizador\Infrastructure\Eloquent\TabuladoRepository;
use Epl\Sincronizador\Infrastructure\Eloquent\TipoAjuRepository;
use Epl\Sincronizador\Infrastructure\Eloquent\TipoCliRepository;
use Epl\Sincronizador\Infrastructure\Eloquent\TipoProRepository;
use Epl\Sincronizador\Infrastructure\Eloquent\UnidadesRepository;
use Epl\Sincronizador\Infrastructure\Eloquent\VendedorRepository;
use Epl\Sincronizador\Infrastructure\Eloquent\ZonaRepository;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SincronizadorBus::class, SincronizadorCommandBus::class);

        $this->app->bind(Container::class, LaravelContainer::class);

        $this->app->bind(SincronizarDataIRepository::class, SolicitarDataRepository::class);
        
        // $this->app->when(CasoUsoCtaIngr::class)->needs(InterfaceRespository::class)->give(CtaIngrRepository::class);
        // $this->app->when(CasoUsoProceden::class)->needs(InterfaceRespository::class)->give(ProcedenRepository::class);
        // $this->app->when(CasoUsoProv::class)->needs(InterfaceRespository::class)->give(ProvRepository::class);
        // $this->app->when(CasoUsoSegmento::class)->needs(InterfaceRespository::class)->give(SegmentoRepository::class);
        // $this->app->when(CasoUsoTabulado::class)->needs(InterfaceRespository::class)->give(TabuladoRepository::class);
        // $this->app->when(CasoUsoTipoAju::class)->needs(InterfaceRespository::class)->give(TipoAjuRepository::class);
        // $this->app->when(CasoUsoTipoCli::class)->needs(InterfaceRespository::class)->give(TipoCliRepository::class);
        // $this->app->when(CasoUsoTipoPro::class)->needs(InterfaceRespository::class)->give(TipoProRepository::class);
        // $this->app->when(CasoUsoUnidades::class)->needs(InterfaceRespository::class)->give(UnidadesRepository::class);
        // $this->app->when(CasoUsoVendedor::class)->needs(InterfaceRespository::class)->give(VendedorRepository::class);
        // $this->app->when(CasoUsoZona::class)->needs(InterfaceRespository::class)->give(ZonaRepository::class);
        
        // $this->app->when(CasoUsoValidarConexionTienda::class)->needs(InterfaceRespository::class)->give(ConnectionRepository::class);
        // $this->app->when(CasoUsoActualizarConexionTienda::class)->needs(InterfaceRespository::class)->give(ConnectionRepository::class);

        $this->app->bind(InterfaceRespository::class, function($app) {
            return [
                ConnectionRepository::class,
                CtaIngrRepository::class,
                ProcedenRepository::class,
                ProvRepository::class,
                SegmentoRepository::class,
                TabuladoRepository::class,
                TipoAjuRepository::class,
                TipoCliRepository::class,
                TipoProRepository::class,
                UnidadesRepository::class,
                VendedorRepository::class,
                ZonaRepository::class,
            ];
        });
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
