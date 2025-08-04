<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    // 👇 Corrige el nombre de la tabla
    protected $table = 'solicitudes';

    protected $fillable = [
    'nombre', 'apellido', 'monitor', 'cpu', 'mainboard',
    'disco_duro', 'memoria_ram', 'otros', 'estado',         
    ];
}