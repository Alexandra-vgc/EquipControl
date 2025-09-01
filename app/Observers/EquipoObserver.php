<?php

namespace App\Observers;

use App\Models\Equipo;
use App\Services\HistorialService;
use Illuminate\Support\Facades\Auth;

class EquipoObserver
{
    public function created(Equipo $equipo)
    {
        HistorialService::registrar([
            'equipo_id'  => $equipo->id,
            'usuario_id' => Auth::id(),
            'accion'     => 'crear',
            'observaciones' => "Se creó el equipo con código: {$equipo->codigo}",
        ]);
    }

    public function updated(Equipo $equipo)
    {
        HistorialService::registrar([
            'equipo_id'  => $equipo->id,
            'usuario_id' => Auth::id(),
            'accion'     => 'actualizado',
            'observaciones' => "Se actualizó el equipo con código: {$equipo->codigo}",
        ]);
    }

    public function deleted(Equipo $equipo)
    {
        HistorialService::registrar([
            'equipo_id'  => $equipo->id,
            'usuario_id' => Auth::id(),
            'accion'     => 'eliminado',
            'observaciones' => "Se eliminó el equipo con código: {$equipo->codigo}",
        ]);
    }
}
