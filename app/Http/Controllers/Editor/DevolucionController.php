<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Devolucion;
use App\Models\User;
use App\Models\Equipo;
use App\Models\Historial;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DevolucionController extends Controller
{
    public function __construct()
    {
        // Verificar que el usuario tenga permiso para registrar devoluciones
        $this->middleware(['auth', 'can:registrar-devoluciones']);
    }

    /**
     * Mostrar formulario de registro de devolución (editor).
     */
    public function create()
    {
        $usuarios = User::all();
        $equipos = Equipo::all();
        return view('editor.devoluciones.create', compact('usuarios', 'equipos'));
    }

    /**
     * Guardar devolución (editor).
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'equipo_id'        => 'required|exists:equipos,id',
            'user_id'          => 'required|exists:users,id',
            'fecha_devolucion' => 'required|date',
            'observaciones'    => 'nullable|string|max:1000',
        ]);

        try {
            DB::beginTransaction();

            // Guardar devolución
            $devolucion = Devolucion::create($data);

            // Registrar historial con el usuario que ejecuta la acción
            Historial::create([
                'equipo_id'     => $devolucion->equipo_id,
                'usuario_id'    => $devolucion->user_id,
                'accion'        => 'devolucion',
                'observaciones' => $data['observaciones'] ?? 'Devolución registrada por ' . Auth::user()->name . ' (editor)',
                'created_by'    => Auth::id(), // Si tienes este campo en tu tabla historial
            ]);

            DB::commit();

            return redirect()->route('editor.devoluciones.create')
                ->with('success', 'Devolución registrada correctamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Error al registrar devolución (editor): '.$e->getMessage(), [
                'request' => $request->all(),
                'user' => Auth::id(),
            ]);
            return redirect()->back()->withInput()->with('error', 'Error al registrar la devolución.');
        }
    }
}