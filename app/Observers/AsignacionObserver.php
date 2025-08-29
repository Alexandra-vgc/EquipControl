<?php

namespace App\Observers;

use App\Models\Asignacion;
use App\Services\HistorialService;

class AsignacionObserver
{
    public function created(Asignacion $asignacion)
    {
        HistorialService::registrar([
            'equipo_id'     => $asignacion->equipo_id,
            'accion'        => 'entrega',
            'observaciones' => 'Asignación creada',
            'metadata'      => ['asignacion_id' => $asignacion->id],
        ]);
    }

    public function updated(Asignacion $asignacion)
    {
        HistorialService::registrar([
            'equipo_id'     => $asignacion->equipo_id,
            'accion'        => 'editar',
            'observaciones' => 'Asignación actualizada',
            'metadata'      => ['asignacion_id' => $asignacion->id],
        ]);
    }

    public function deleted(Asignacion $asignacion)
    {
        HistorialService::registrar([
            'equipo_id'     => $asignacion->equipo_id,
            'accion'        => 'devolucion',
            'observaciones' => 'Asignación eliminada (devolución)',
            'metadata'      => ['asignacion_id' => $asignacion->id],
        ]);
    }
}
