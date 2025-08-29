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
    public function register()
    {
        //
    }

    public function boot()
    {
        // Registrar los Observers
        Asignacion::observe(AsignacionObserver::class);
        Devolucion::observe(DevolucionObserver::class);
        Equipo::observe(EquipoObserver::class);
    }
}
