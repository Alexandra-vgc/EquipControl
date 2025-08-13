<?php

namespace App\Http\Controllers;

use App\Models\Devolucion;
use App\Models\Equipo;
use App\Models\User;
use Illuminate\Http\Request;

class DevolucionController extends Controller
{
    // Mostrar formulario para crear devolución
    public function create()
    {
        $usuarios = User::all();
        $equipos = Equipo::all();
        return view('devoluciones.create', compact('usuarios', 'equipos'));
    }

    // Guardar devolución en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'equipo_id' => 'required|exists:equipos,id',
            'fecha_devolucion' => 'required|date',
            'observaciones' => 'nullable|string',
        ]);

        Devolucion::create($request->all());

        return redirect()->route('devoluciones.create')
                         ->with('success', 'Devolución registrada correctamente');
    }
}
