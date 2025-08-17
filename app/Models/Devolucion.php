<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    use HasFactory;

    protected $table = 'devoluciones'; // <- fuerza el nombre correcto de la tabla

    protected $fillable = [
        'user_id',
        'equipo_id',
        'fecha_devolucion',
        'observaciones',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function equipo() {
        return $this->belongsTo(Equipo::class);
    }
}
