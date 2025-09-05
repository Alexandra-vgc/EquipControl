<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Equipo;
use App\Models\Devolucion;
use App\Models\Asignacion;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function dashboard()
    {
        // Contar equipos por estado
        $equiposAsignados = Equipo::where('estado', 'Asignado')->count();
        $equiposDisponibles = Equipo::where('estado', 'Disponible')->count();
        $equiposReparacion = Equipo::where('estado', 'En Reparación')->count();
        $equiposDanados = Equipo::where('estado', 'Dañado')->count();

        // Listas de equipos para los modales
        $equiposAsignadosLista = Equipo::where('estado', 'Asignado')->get();
        $equiposDisponiblesLista = Equipo::where('estado', 'Disponible')->get();
        $equiposReparacionLista = Equipo::where('estado', 'En Reparación')->get();
        $equiposDanadosLista = Equipo::where('estado', 'Dañado')->get();

        // Últimas entregas (equipos que cambiaron a 'Asignado' recientemente)
        $ultimasEntregas = Equipo::where('estado', 'Asignado')
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        // Últimas devoluciones (si tienes modelo Devolucion)
        $ultimasDevoluciones = collect(); // Inicializar como colección vacía
        if (class_exists(\App\Models\Devolucion::class)) {
            try {
                $ultimasDevoluciones = Devolucion::orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();
            } catch (\Exception $e) {
                // Si no existe la tabla, mantener colección vacía
                $ultimasDevoluciones = collect();
            }
        }

        // Conteo por tipo de equipo para gráfico
        $equiposTipo = Equipo::selectRaw('tipo, COUNT(*) as total')
            ->groupBy('tipo')
            ->pluck('total', 'tipo')
            ->toArray();

        return view('admin.dashboard', compact(
            'equiposAsignados',
            'equiposDisponibles', 
            'equiposReparacion',
            'equiposDanados',
            'equiposAsignadosLista',
            'equiposDisponiblesLista',
            'equiposReparacionLista', 
            'equiposDanadosLista',
            'ultimasEntregas',
            'ultimasDevoluciones',
            'equiposTipo'
        ));
    }

    public function create()
    {
        $this->authorize('crear contenido');
        return view('admin.create-content');
    }

    public function store(Request $request)
    {
        $this->authorize('crear contenido');
        // Lógica para guardar contenido
    }

    public function edit($id)
    {
        $this->authorize('editar contenido');
        return view('admin.edit-content', compact('id'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('editar contenido');
        // Lógica para actualizar contenido
    }

    public function destroy($id)
    {
        $this->authorize('eliminar contenido');
        // Lógica para eliminar contenido
    }
}