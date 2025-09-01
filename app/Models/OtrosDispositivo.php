<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtrosDispositivo extends Model
{
    use HasFactory;

    protected $table = 'otros_dispositivos';

    protected $fillable = [
        'tipo',
        'marca',
        'modelo',
        'serial',
        'observacion',
        'asignacion_id'
    ];

    public function asignacion()
    {
        return $this->belongsTo(Asignacion::class, 'asignacion_id');
    }
}
