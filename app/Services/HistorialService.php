<?php

namespace App\Services;

use App\Models\Historial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Log;

class HistorialService
{
    public static function registrar(array $data)
    {
        try {
            $payload = [
                'equipo_id'     => $data['equipo_id'] ?? null,
                'usuario_id'    => $data['usuario_id'] ?? Auth::id(),
                'accion'        => $data['accion'] ?? 'accion',
                'observaciones' => $data['observaciones'] ?? null,
                'ip'            => Request::ip(),
                'ruta'          => Request::path(),
                'metadata'      => $data['metadata'] ?? null,
            ];

            // evitar duplicados rápidos (3 segundos)
            $recent = Historial::where('equipo_id', $payload['equipo_id'])
                ->where('accion', $payload['accion'])
                ->where('usuario_id', $payload['usuario_id'])
                ->where('created_at', '>=', now()->subSeconds(3))
                ->exists();

            if ($recent) {
                return null;
            }

            return Historial::create($payload);
        } catch (\Throwable $e) {
            Log::error('HistorialService error: '.$e->getMessage());
            return null;
        }
    }
}
