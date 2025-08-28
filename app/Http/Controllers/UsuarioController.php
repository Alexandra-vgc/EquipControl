<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    public function editarPerfil()
    {
        $user = Auth::user();
        return view('usuario.perfil', compact('user'));
    }

    public function actualizarPerfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'document' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->name = $request->name;
        $user->document = $request->document;
        $user->phone = $request->phone;

        // ✅ Guardar nueva foto si viene
        if ($request->hasFile('avatar')) {
            // borrar la foto anterior (opcional)
            if ($user->avatar && Storage::exists('public/'.$user->avatar)) {
                Storage::delete('public/'.$user->avatar);
            }

            $path = $request->file('avatar')->store('usuarios', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->back()->with('success', 'Perfil actualizado correctamente ✅');
    }
}
