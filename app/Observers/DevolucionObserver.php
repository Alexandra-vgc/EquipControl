<?php

namespace App\Observers;

use App\Models\Devolucion;
use App\Services\HistorialService;

class DevolucionObserver
{
    public function created(Devolucion $devolucion)
    {
        HistorialService::registrar([
            'equipo_id'     => $devolucion->equipo_id,
            'accion'        => 'devolucion',
            'observaciones' => $devolucion->observaciones ?? 'Devolución registrada',
            'metadata'      => ['devolucion_id' => $devolucion->id],
        ]);
    }

    public function updated(Devolucion $devolucion)
    {
        HistorialService::registrar([
            'equipo_id'     => $devolucion->equipo_id,
            'accion'        => 'editar',
            'observaciones' => 'Devolución actualizada',
            'metadata'      => ['devolucion_id' => $devolucion->id],
        ]);
    }

    public function deleted(Devolucion $devolucion)
    {
        HistorialService::registrar([
            'equipo_id'     => $devolucion->equipo_id,
            'accion'        => 'eliminar',
            'observaciones' => 'Registro de devolución eliminado',
            'metadata'      => ['devolucion_id' => $devolucion->id],
        ]);
    }
}
