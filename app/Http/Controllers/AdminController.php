<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function dashboard()
    {
        return view('admin.dashboard');
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
