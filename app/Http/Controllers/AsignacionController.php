<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\AsignacionDetalle;
use App\Models\Equipo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class AsignacionController extends Controller
{
    public function create()
    {
        $usuarios  = User::orderBy('name')->get();
        $cpus      = Equipo::where('tipo', 'CPU')->where('estado', 'Disponible')->get();
        $monitores = Equipo::where('tipo', 'Monitor')->where('estado', 'Disponible')->get();
        $teclados  = Equipo::where('tipo', 'Teclado')->where('estado', 'Disponible')->get();
        $mouses    = Equipo::where('tipo', 'Mouse')->where('estado', 'Disponible')->get();

        return view('entregas.crear', compact('usuarios', 'cpus', 'monitores', 'teclados', 'mouses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'       => 'required|exists:users,id',
            'fecha_entrega' => 'required|date',
            'equipos'       => 'required|array|min:1',
        ], [
            'equipos.required' => 'Selecciona al menos un equipo.'
        ]);

        $asignacion = DB::transaction(function () use ($request) {
            $asig = Asignacion::create([
                'user_id'       => $request->user_id,
                'fecha_entrega' => $request->fecha_entrega,
                'observaciones' => $request->observaciones,
            ]);

            foreach ($request->equipos as $equipoId) {
                AsignacionDetalle::create([
                    'asignacion_id' => $asig->id,
                    'equipo_id'     => $equipoId,
                ]);
                Equipo::where('id', $equipoId)->update(['estado' => 'Asignado']);
            }

            return $asig;
        });

        return redirect()->route('entregas.pdf', $asignacion->id);
    }

    public function pdf($id)
    {
        $asignacion = Asignacion::with(['usuario', 'detalles.equipo'])->findOrFail($id);

        $pdf = Pdf::loadView('entregas.pdf', compact('asignacion'))->setPaper('A4');

        return $pdf->download("Entrega_{$asignacion->id}.pdf");
    }
}
