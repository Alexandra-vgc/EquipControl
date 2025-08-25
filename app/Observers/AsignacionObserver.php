<?php

namespace App\Observers;

use App\Models\Asignacion;
use Illuminate\Support\Facades\Log;
use App\Services\HistorialService;

class AsignacionObserver
{
    public function created(Asignacion $asignacion)
    {
        try {
            HistorialService::registrar([
                'equipo_id'     => $asignacion->equipo_id,
                'accion'        => 'entrega',
                'observaciones' => 'Asignación creada',
                'metadata'      => ['asignacion_id' => $asignacion->id],
            ]);
            Log::info('AsignacionObserver: historial creado', ['id'=>$asignacion->id]);
        } catch (\Throwable $e) {
            Log::error('AsignacionObserver created error: '.$e->getMessage());
        }
    }

    public function updated(Asignacion $asignacion)
    {
        try {
            HistorialService::registrar([
                'equipo_id'     => $asignacion->equipo_id,
                'accion'        => 'editar',
                'observaciones' => 'Asignación actualizada',
                'metadata'      => ['asignacion_id' => $asignacion->id],
            ]);
        } catch (\Throwable $e) {
            Log::error('AsignacionObserver updated error: '.$e->getMessage());
        }
    }

    public function deleted(Asignacion $asignacion)
    {
        try {
            HistorialService::registrar([
                'equipo_id'     => $asignacion->equipo_id,
                'accion'        => 'devolucion',
                'observaciones' => 'Asignación eliminada (se considera devolución)',
                'metadata'      => ['asignacion_id' => $asignacion->id],
            ]);
        } catch (\Throwable $e) {
            Log::error('AsignacionObserver deleted error: '.$e->getMessage());
        }
    }
}
