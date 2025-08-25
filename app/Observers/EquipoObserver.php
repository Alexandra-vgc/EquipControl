<?php

namespace App\Observers;

use App\Models\Equipo;
use App\Models\Historial;
use Illuminate\Support\Facades\Auth;

class EquipoObserver
{
    /**
     * Cuando se crea un equipo nuevo.
     */
    public function created(Equipo $equipo)
    {
        Historial::create([
            'equipo_id'  => $equipo->id,
            'usuario_id' => Auth::id(), // 👈 guarda el usuario logueado
            'accion'     => 'entrega',
            'detalle'    => "Se creó el equipo con serie: {$equipo->serie}",
        ]);
    }

    /**
     * Cuando se actualiza un equipo.
     */
    public function updated(Equipo $equipo)
    {
        Historial::create([
            'equipo_id'  => $equipo->id,
            'usuario_id' => Auth::id(),
            'accion'     => 'actualizado',
            'detalle'    => "Se actualizó el equipo con serie: {$equipo->serie}",
        ]);
    }

    /**
     * Cuando se elimina un equipo.
     */
    public function deleted(Equipo $equipo)
    {
        Historial::create([
            'equipo_id'  => $equipo->id,
            'usuario_id' => Auth::id(),
            'accion'     => 'eliminado',
            'detalle'    => "Se eliminó el equipo con serie: {$equipo->serie}",
        ]);
    }
}
