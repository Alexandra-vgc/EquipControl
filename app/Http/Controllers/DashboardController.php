<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Contadores generales
        $equiposTotal = Equipo::count();
        $equiposAsignados = Equipo::where('estado', 'asignado')->count();
        $equiposReparacion = Equipo::where('estado', 'En Reparacion')->count();
        $equiposDisponibles = Equipo::where('estado', 'disponible')->count();
        $equiposDanados = Equipo::where('estado', 'danado')->count(); 
        $devolucionesPendientes = Equipo::where('estado', 'pendiente_devolucion')->count();

        // Últimos registros
        $ultimasEntregas = Equipo::where('estado', 'asignado')
            ->latest()
            ->take(5)
            ->get();

        $ultimasDevoluciones = Equipo::where('estado', 'devuelto')
            ->latest()
            ->take(5)
            ->get();

        // Conteo por tipo de equipo (para gráfico de barras)
        $equiposTipo = Equipo::selectRaw('tipo, COUNT(*) as total')
            ->groupBy('tipo')
            ->pluck('total', 'tipo')
            ->toArray();

        // Listas completas por estado (para los modales o despliegues)
        $equiposAsignadosLista = Equipo::where('estado', 'asignado')->get();
        $equiposDisponiblesLista = Equipo::where('estado', 'disponible')->get();
        $equiposReparacionLista = Equipo::where('estado', 'En Reparacion')->get();
        $equiposDanadosLista = Equipo::where('estado', 'danado')->get();

        return view('admin.dashboard', compact(
            'equiposTotal',
            'equiposAsignados',
            'equiposReparacion',
            'equiposDisponibles',
            'equiposDanados',
            'devolucionesPendientes',
            'ultimasEntregas',
            'ultimasDevoluciones',
            'equiposTipo',
            'equiposAsignadosLista',
            'equiposDisponiblesLista',
            'equiposReparacionLista',
            'equiposDanadosLista'
        ));
    }
}
