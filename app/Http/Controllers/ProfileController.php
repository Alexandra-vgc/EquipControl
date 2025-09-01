<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Mostrar perfil del usuario autenticado
     */
    public function editarPerfil()
    {
        $user = Auth::user(); // Usuario logueado
        return view('usuario.perfil', compact('user'));
    }

    /**
     * Actualizar todo el perfil desde un formulario completo
     */
    public function actualizarPerfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . $user->id,
            'telefono' => 'nullable|string|max:20',
            'direccion'=> 'nullable|string|max:255',
        ]);

        $user->update($request->only('name', 'email', 'telefono', 'direccion'));

        return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Actualizar un solo campo (ideal para ventanitas modales o AJAX)
     */
    public function updateField(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'field' => 'required|string',
            'value' => 'nullable|string|max:255',
        ]);

        $field = $request->input('field');
        $value = $request->input('value');

        if (in_array($field, ['name', 'email', 'telefono', 'direccion'])) {
            $user->$field = $value;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => ucfirst($field) . ' actualizado correctamente.',
                'value'   => $value
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Campo no permitido.'
        ], 400);
    }
}
