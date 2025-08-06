<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'marca',
        'modelo',
        'serie',
        'codigo',
        'caracteristicas',
        'estado',
    ];

    public function detalles()
    {
        return $this->hasMany(AsignacionDetalle::class);
    }
}
