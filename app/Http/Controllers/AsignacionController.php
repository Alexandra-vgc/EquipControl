<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\AsignacionDetalle;
use App\Models\Equipo;
use App\Models\OtrosDispositivo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
            'asignacion_id'        => 'required|exists:asignaciones,id',
            'tarjeta_red'          => 'nullable|array',
            'parlantes'            => 'nullable|array',
            'tarjeta_video'        => 'nullable|array',
            'tarjeta_audio'        => 'nullable|array',
            'optico'               => 'nullable|array',
            'sd'                   => 'nullable|array',
            'telefono_serial'      => 'nullable|string',
            'ip'                   => 'nullable|string',
            'otros'                => 'nullable|string',
            'otros_dispositivos'   => 'nullable|array',
            'uso_equipo'           => 'nullable|array',
            'verificacion_funcional'=> 'nullable|array',
            'imagenes.*'           => 'nullable|image|max:5120',
        ]);

        $detalles = AsignacionDetalle::where('asignacion_id', $data['asignacion_id'])->get();

        foreach($detalles as $detalle){
            $detalle->tarjeta_red   = is_array($data['tarjeta_red'] ?? null) ? implode(', ', $data['tarjeta_red']) : $data['tarjeta_red'] ?? null;
            $detalle->parlantes     = is_array($data['parlantes'] ?? null) ? implode(', ', $data['parlantes']) : $data['parlantes'] ?? null;
            $detalle->tarjeta_video = is_array($data['tarjeta_video'] ?? null) ? implode(', ', $data['tarjeta_video']) : $data['tarjeta_video'] ?? null;
            $detalle->tarjeta_audio = is_array($data['tarjeta_audio'] ?? null) ? implode(', ', $data['tarjeta_audio']) : $data['tarjeta_audio'] ?? null;
            $detalle->optico        = is_array($data['optico'] ?? null) ? implode(', ', $data['optico']) : $data['optico'] ?? null;
            $detalle->sd            = is_array($data['sd'] ?? null) ? implode(', ', $data['sd']) : $data['sd'] ?? null;
            $detalle->telefono_serial = $data['telefono_serial'] ?? null;
            $detalle->ip            = $data['ip'] ?? null;
            $detalle->otros         = $data['otros'] ?? null;
            $detalle->uso_equipo    = is_array($data['uso_equipo'] ?? null) ? implode(', ', $data['uso_equipo']) : $data['uso_equipo'] ?? null;
            $detalle->verificacion_funcional = is_array($data['verificacion_funcional'] ?? null) ? implode(', ', $data['verificacion_funcional']) : $data['verificacion_funcional'] ?? null;
            $detalle->save();
        }

        // Guardar otros dispositivos
        if(isset($data['otros_dispositivos'])){
            $asignacion = Asignacion::find($data['asignacion_id']);
            foreach($data['otros_dispositivos'] as $od){
                OtrosDispositivo::create([
                    'tipo' => $od['tipo'] ?? null,
                    'marca' => $od['marca'] ?? null,
                    'modelo' => $od['modelo'] ?? null,
                    'serial' => $od['serial'] ?? null,
                    'observacion' => $od['observacion'] ?? null,
                    'asignacion_id' => $data['asignacion_id']
                ]);
            }
        }

        // Guardar imágenes
        if($request->hasFile('imagenes')){
            $imagenes = [];
            foreach($request->file('imagenes') as $img){
                $path = $img->store('asignaciones', 'public');
                $imagenes[] = $path;
            }
            foreach($detalles as $detalle){
                $detalle->imagenes = json_encode($imagenes);
                $detalle->save();
            }
        }

        return redirect()->route('entregas.pdf', $data['asignacion_id']);
    }

    // Generar PDF de la asignación
    public function pdf($id)
    {
        $asignacion = Asignacion::with(['usuario', 'detalles.equipo', 'otrosDispositivos'])->findOrFail($id);

        $pdf = Pdf::loadView('entregas.pdf', compact('asignacion'))->setPaper('A4');

        return $pdf->download("Entrega_{$asignacion->id}.pdf");
    }
}
