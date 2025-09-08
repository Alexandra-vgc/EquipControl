<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pdf extends Model
{
    use HasFactory;

    protected $fillable = [
        'asignacion_id',
        'nombre',
        'archivo',
    ];

    public function asignacion()
    {
        return $this->belongsTo(Asignacion::class);
    }
}
