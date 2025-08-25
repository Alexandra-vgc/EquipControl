<?php

namespace App\Http\Controllers\Admin;

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
    /**
     * Mostrar formulario de registro de devolución.
     */
    public function create()
    {
        $usuarios = User::all();
        $equipos = Equipo::all();
        return view('admin.devoluciones.create', compact('usuarios', 'equipos'));
    }

    /**
     * Guardar devolución.
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

            // Registrar historial
            Historial::create([
                'equipo_id'     => $devolucion->equipo_id,
                'usuario_id'    => $devolucion->user_id,
                'accion'        => 'devolucion',
                'observaciones' => $data['observaciones'] ?? 'Devolución registrada desde UI',
            ]);

            DB::commit();

            return redirect()->route('admin.devoluciones.create')
                ->with('success', 'Devolución registrada correctamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Error al registrar devolución / historial: '.$e->getMessage(), [
                'request' => $request->all(),
            ]);
            return redirect()->back()->withInput()->with('error', 'Error al registrar la devolución.');
        }
    }
}