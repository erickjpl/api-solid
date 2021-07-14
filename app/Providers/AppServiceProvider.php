<?php

namespace App\Providers;

use Epl\Sincronizador\Application\Bus\Contracts\Container;
use Epl\Sincronizador\Domain\Contracts\InterfaceRespository;
use Epl\Sincronizador\Domain\Contracts\SincronizarDataIRepository;
use Epl\Sincronizador\Domain\Events\BuscarDataProfit;
use Epl\Sincronizador\Infrastructure\Bus\LaravelContainer;
use Epl\Sincronizador\Infrastructure\Bus\SincronizadorCommandBus;
use Epl\Sincronizador\Infrastructure\Bus\Contracts\SincronizadorBus;
use Epl\Sincronizador\Infrastructure\Eloquent\ConnectionRepository;
use Epl\Sincronizador\Infrastructure\Eloquent\CtaIngrRepository;
use Epl\Sincronizador\Infrastructure\Eloquent\ProcedenRepository;
use Epl\Sincronizador\Infrastructure\Eloquent\SolicitarDataRepository;
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

        $this->app->bind(InterfaceRespository::class, ConnectionRepository::class);

        $this->app->when(BuscarDataProfit::class)->needs(InterfaceRespository::class)->give(CtaIngrRepository::class);
        $this->app->when(BuscarDataProfit::class)->needs(InterfaceRespository::class)->give(ProcedenRepository::class);
        $this->app->when(BuscarDataProfit::class)->needs(InterfaceRespository::class)->give(ProvRepository::class);
        $this->app->when(BuscarDataProfit::class)->needs(InterfaceRespository::class)->give(SegmentoRepository::class);
        $this->app->when(BuscarDataProfit::class)->needs(InterfaceRespository::class)->give(TabuladoRepository::class);
        $this->app->when(BuscarDataProfit::class)->needs(InterfaceRespository::class)->give(TipoAjuRepository::class);
        $this->app->when(BuscarDataProfit::class)->needs(InterfaceRespository::class)->give(TipoCliRepository::class);
        $this->app->when(BuscarDataProfit::class)->needs(InterfaceRespository::class)->give(TipoProRepository::class);
        $this->app->when(BuscarDataProfit::class)->needs(InterfaceRespository::class)->give(UnidadesRepository::class);
        $this->app->when(BuscarDataProfit::class)->needs(InterfaceRespository::class)->give(VendedorRepository::class);
        $this->app->when(BuscarDataProfit::class)->needs(InterfaceRespository::class)->give(ZonaRepository::class);
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
