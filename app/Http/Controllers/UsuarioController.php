<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role; // 👈 IMPORTANTE para usar roles

class UsuarioController extends Controller
{
    // ---------- PERFIL ----------
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

    // ---------- ASIGNAR ROLES (solo admin) ----------
    public function asignar()
    {
        $usuarios = User::all();
        $roles = Role::whereIn('name', ['admin', 'editor', 'lector'])->get();

       return view('usuario.asignar', compact('usuarios', 'roles'));

    }

    public function asignarRol(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::findOrFail($request->user_id);

        // Quita roles anteriores y asigna el nuevo
        $user->syncRoles([$request->role]);

        return redirect()->back()->with('success', 'Rol asignado correctamente ✅');
    }
}
