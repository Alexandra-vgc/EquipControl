<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;


class UsuarioController extends Controller
{
    public function editarPerfil()
    {
        $usuario = session('usuario');

        // Si no tiene imagen, se pone una por defecto
        $usuario['imagen'] = $usuario['imagen'] ?? 'usuario.png';

        return view('usuario.perfil', compact('usuario'));
    }


    public function asignar() {
    $usuarios = User::all();
    $roles = Role::all();
    return view('usuario.asignar', compact('usuarios', 'roles'));
}

public function asignarRol(Request $request) {
    $user = User::findOrFail($request->user_id);
    $user->assignRole($request->rol);
    return redirect()->back()->with('success', 'Rol asignado correctamente');
}

}
