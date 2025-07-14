<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function editarPerfil()
    {
        $usuario = session('usuario');

        // Si no tiene imagen, se pone una por defecto
        $usuario['imagen'] = $usuario['imagen'] ?? 'usuario.png';

        return view('usuario.perfil', compact('usuario'));
    }
}
