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
    // Mostrar formulario de creación
    public function create()
    {
        $usuarios  = User::orderBy('name')->get();
        $cpus      = Equipo::where('tipo', 'CPU')->where('estado', 'Disponible')->get();
        $monitores = Equipo::where('tipo', 'Monitor')->where('estado', 'Disponible')->get();
        $teclados  = Equipo::where('tipo', 'Teclado')->where('estado', 'Disponible')->get();
        $mouses    = Equipo::where('tipo', 'Mouse')->where('estado', 'Disponible')->get();

        return view('entregas.crear', compact('usuarios', 'cpus', 'monitores', 'teclados', 'mouses'));
    }

    // Guardar asignación y equipos seleccionados
    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string',
            'correo'       => 'required|email',
            'equipos'      => 'required|array|min:1',
        ], [
            'equipos.required' => 'Selecciona al menos un equipo.'
        ]);

        $asignacion = DB::transaction(function () use ($request) {
            $asig = Asignacion::create([
                'nombre' => $request->nombre,
                'correo' => $request->correo,
                'cargo' => $request->cargo,
                'area' => $request->area,
                'sede' => $request->sede,
                'user_id' => auth()->id(),
                'fecha_entrega' => now(),
            ]);

            foreach ($request->equipos as $equipoId) {
                AsignacionDetalle::create([
                    'asignacion_id' => $asig->id,
                    'equipo_id'     => $equipoId,
                ]);

                $equipo = Equipo::find($equipoId);
                if ($equipo) {
                    $equipo->estado = 'Asignado';
                    $equipo->save();
                }
            }

            return $asig;
        });

        // Redirigir a la vista2
        return redirect()->route('asignaciones.vista2', $asignacion->id);
    }

    // Mostrar la vista2 para completar detalles técnicos
    public function vista2(Asignacion $asignacion)
    {
        return view('entregas.vista2', compact('asignacion'));
    }

    // Guardar los detalles técnicos de la vista2
    public function guardarDetalles(Request $request)
    {
        $data = $request->validate([
            'asignacion_id' => 'required|exists:asignacions,id',
            'tarjeta_red'   => 'array',
            'parlantes'     => 'array',
            'tarjeta_video' => 'array',
            'tarjeta_audio' => 'array',
            'optico'        => 'array',
            'sd'            => 'array',
            'seguridad'     => 'nullable|string',
            'telefono'      => 'nullable|string',
            'serial'        => 'nullable|string',
            'ip'            => 'nullable|string',
            'otros'         => 'nullable|string',
        ]);

        $detalle = AsignacionDetalle::where('asignacion_id', $data['asignacion_id'])->first();
        if (!$detalle) {
            $detalle = new AsignacionDetalle();
            $detalle->asignacion_id = $data['asignacion_id'];
        }

        $detalle->tarjeta_red   = isset($data['tarjeta_red']) ? implode(',', $data['tarjeta_red']) : null;
        $detalle->parlantes     = isset($data['parlantes']) ? implode(',', $data['parlantes']) : null;
        $detalle->tarjeta_video = isset($data['tarjeta_video']) ? implode(',', $data['tarjeta_video']) : null;
        $detalle->tarjeta_audio = isset($data['tarjeta_audio']) ? implode(',', $data['tarjeta_audio']) : null;
        $detalle->optico        = isset($data['optico']) ? implode(',', $data['optico']) : null;
        $detalle->sd            = isset($data['sd']) ? implode(',', $data['sd']) : null;
        $detalle->seguridad     = $data['seguridad'] ?? null;
        $detalle->telefono      = $data['telefono'] ?? null;
        $detalle->serial        = $data['serial'] ?? null;
        $detalle->ip            = $data['ip'] ?? null;
        $detalle->otros         = $data['otros'] ?? null;

        $detalle->save();

        return redirect()->route('entregas.pdf', $detalle->asignacion_id);
    }

    // Generar PDF de la asignación
    public function pdf($id)
    {
        $asignacion = Asignacion::with(['usuario', 'detalles.equipo'])->findOrFail($id);

        $pdf = Pdf::loadView('entregas.pdf', compact('asignacion'))->setPaper('A4');

        return $pdf->download("Entrega_{$asignacion->id}.pdf");
    }
}
