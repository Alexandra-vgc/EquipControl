<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Asignacion;
use App\Models\Devolucion;
use App\Models\Equipo;
use App\Observers\AsignacionObserver;
use App\Observers\DevolucionObserver;
use App\Observers\EquipoObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Asignacion::observe(AsignacionObserver::class);
        Devolucion::observe(DevolucionObserver::class);
        Equipo::observe(EquipoObserver::class);
    }
}
