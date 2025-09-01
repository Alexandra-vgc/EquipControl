<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionDetalle extends Model
{
    use HasFactory;

    protected $table = 'asignacion_detalles';

    protected $fillable = [
        'asignacion_id',
        'equipo_id',
        'tarjeta_red',
        'parlantes',
        'tarjeta_video',
        'tarjeta_audio',
        'optico',
        'sd',
        'seguridad',
        'telefono_serial',
        'serial',
        'ip',
        'otros',
        'imagenes', // Guardará rutas de imágenes en JSON
        'uso_equipo', // Guardará uso del equipo en CSV o JSON
        'verificacion_funcional', // Guardará verificación en CSV o JSON
    ];

    // Relación con la asignación principal
    public function asignacion()
    {
        return $this->belongsTo(Asignacion::class, 'asignacion_id');
    }

    // Relación con el equipo asignado
    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }

    // Convertir los campos JSON a array automáticamente al acceder
    protected $casts = [
        'imagenes' => 'array',
        'uso_equipo' => 'array',
        'verificacion_funcional' => 'array',
        'tarjeta_red' => 'array',
        'parlantes' => 'array',
        'tarjeta_video' => 'array',
        'tarjeta_audio' => 'array',
        'optico' => 'array',
        'sd' => 'array',
    ];
}
