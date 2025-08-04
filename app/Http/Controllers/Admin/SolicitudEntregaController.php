<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Solicitud;

class SolicitudEntregaController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->input('buscar');

        $solicitudes = Solicitud::when($busqueda, function ($query, $busqueda) {
            return $query->where('nombre', 'like', "%$busqueda%")
                         ->orWhere('apellido', 'like', "%$busqueda%");
        })->get();

        return view('admin.solicitudes.index', compact('solicitudes', 'busqueda'));
    }

    public function create()
    {
        return view('admin.solicitudes.create');
    }

    public function store(Request $request)
    {
        // Validar los datos antes de guardar
        $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'estado' => 'required|string|in:pendiente,aprobado,negado',
        ]);
        // Crear solicitud con solo los campos permitidos
        Solicitud::create($request->only([
            'nombre', 'apellido', 'estado'
        ]));

        return redirect()->route('admin.solicitudes.index')->with('success', 'Solicitud registrada correctamente.');
    }

    public function edit($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        return view('admin.solicitudes.edit', compact('solicitud'));
    }

    public function update(Request $request, $id)
    {
        // Validar datos para actualizar
        $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'estado' => 'required|in:pendiente,aprobado,negado',
        ]);

        $solicitud = Solicitud::findOrFail($id);

        $solicitud->update($request->only([
            'nombre', 'apellido','estado'
        ]));

        return redirect()->route('admin.solicitudes.index')->with('success', 'Solicitud actualizada correctamente.');
    }

    public function destroy($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->delete();

        return redirect()->route('admin.solicitudes.index')->with('success', 'Solicitud actualizada correctamente.');   
        return redirect()->route('admin.solicitudes.index')->with('success', 'Solicitud eliminada correctamente.');
    }
}
