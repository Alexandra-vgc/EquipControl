<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';
    
    protected $fillable = [
        'tipo',
        'codigo',
        'marca',
        'modelo',
        'serial', // antes era serie
        'caracteristicas',
        'estado',
        'mainboard_marca',
        'mainboard_modelo',
        'procesador',
        'memoria_ram',
        'capacidad_disco',
        'energia'
    ];

    // Definir los tipos disponibles (basado en tus datos)
    public static function getTipos()
    {
        return [
            'Monitor' => 'Monitor',
            'CPU' => 'CPU/Computadora', 
            'Teclado' => 'Teclado',
            'Mouse' => 'Mouse',
            'Impresora' => 'Impresora',
            'Laptop' => 'Laptop',
            'Tablet' => 'Tablet',
            'Telefono' => 'Teléfono',
            'Proyector' => 'Proyector',
            'Router' => 'Router',
            'Switch' => 'Switch',
            'UPS' => 'UPS',
            'Otros' => 'Otros'
        ];
    }

    // Definir los estados disponibles
    public static function getEstados()
    {
        return [
            'Disponible' => 'Disponible',
            'Asignado' => 'Asignado', 
            'Mantenimiento' => 'En Mantenimiento',
            'Dañado' => 'Dañado',
            'Obsoleto' => 'Obsoleto',
            'Baja' => 'Dado de Baja'
        ];
    }

    // Accessor para mostrar el tipo de forma legible
    public function getTipoFormattedAttribute()
    {
        $tipos = self::getTipos();
        return $tipos[$this->tipo] ?? $this->tipo;
    }

    // Accessor para mostrar el estado de forma legible
    public function getEstadoFormattedAttribute()
    {
        $estados = self::getEstados();
        return $estados[$this->estado] ?? 'Sin estado';
    }

    // Accessor para obtener la clase CSS del badge según el estado
    public function getEstadoBadgeClassAttribute()
    {
        $classes = [
            'Disponible' => 'badge-success',
            'Asignado' => 'badge-primary',
            'Mantenimiento' => 'badge-warning', 
            'Dañado' => 'badge-danger',
            'Obsoleto' => 'badge-secondary',
            'Baja' => 'badge-dark'
        ];
        
        return $classes[$this->estado] ?? 'badge-secondary';
    }
}
