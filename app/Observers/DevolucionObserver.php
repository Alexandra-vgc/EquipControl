<?php

namespace App\Observers;

use App\Models\Devolucion;
use Illuminate\Support\Facades\Log;
use App\Services\HistorialService;

class DevolucionObserver
{
    public function created(Devolucion $devolucion)
    {
        try {
            HistorialService::registrar([
                'equipo_id'     => $devolucion->equipo_id,
                'accion'        => 'devolucion',
                'observaciones' => $devolucion->observaciones ?? 'Devolución registrada',
                'metadata'      => ['devolucion_id' => $devolucion->id],
            ]);
            Log::info('DevolucionObserver: historial creado', ['id'=>$devolucion->id]);
        } catch (\Throwable $e) {
            Log::error('DevolucionObserver created error: '.$e->getMessage());
        }
    }

    public function updated(Devolucion $devolucion)
    {
        try {
            HistorialService::registrar([
                'equipo_id'     => $devolucion->equipo_id,
                'accion'        => 'editar',
                'observaciones' => 'Devolución actualizada',
                'metadata'      => ['devolucion_id' => $devolucion->id],
            ]);
        } catch (\Throwable $e) {
            Log::error('DevolucionObserver updated error: '.$e->getMessage());
        }
    }

    public function deleted(Devolucion $devolucion)
    {
        try {
            HistorialService::registrar([
                'equipo_id'     => $devolucion->equipo_id,
                'accion'        => 'eliminar',
                'observaciones' => 'Registro de devolución eliminado',
                'metadata'      => ['devolucion_id' => $devolucion->id],
            ]);
        } catch (\Throwable $e) {
            Log::error('DevolucionObserver deleted error: '.$e->getMessage());
        }
    }
}
