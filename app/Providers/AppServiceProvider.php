<?php

namespace App\Providers;

use Epl\Sincronizador\Application\Bus\Contracts\Container;
use Epl\Sincronizador\Infrastructure\Bus\LaravelContainer;
use Epl\Sincronizador\Infrastructure\Bus\SincronizadorCommandBus;
use Epl\Sincronizador\Infrastructure\Bus\Contracts\SincronizadorBus;
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
