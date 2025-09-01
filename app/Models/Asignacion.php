<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    use HasFactory;

    protected $table = 'asignaciones';

    protected $fillable = [
        'nombre',
        'correo',
        'cargo',
        'area',
        'sede',
        'user_id',
        'fecha_entrega',
        'observaciones',
        'pdf_path'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detalles()
    {
        return $this->hasMany(AsignacionDetalle::class, 'asignacion_id');
    }

    public function otrosDispositivos()
    {
        return $this->hasMany(OtrosDispositivo::class, 'asignacion_id');
    }
}
