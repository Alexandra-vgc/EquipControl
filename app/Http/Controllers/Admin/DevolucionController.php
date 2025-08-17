<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Devolucion;
use App\Models\User;
use App\Models\Equipo;

class DevolucionController extends Controller
{
    public function create()
    {
        $usuarios = User::all();
        $equipos = Equipo::all();
        return view('admin.devoluciones.create', compact('usuarios', 'equipos'));
    }

    public function store(Request $request)
    {
        Devolucion::create($request->all());
        return redirect()->route('admin.devoluciones.create')->with('success', 'Devolución registrada con éxito.');
    }
}
