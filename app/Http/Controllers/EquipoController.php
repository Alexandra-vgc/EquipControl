<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function create()
    {
        $tipos = ['CPU','Monitor','Teclado','Mouse'];
        return view('equipos.create', compact('tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo'            => 'required|in:CPU,Monitor,Teclado,Mouse',
            'marca'           => 'nullable|string|max:100',
            'modelo'          => 'nullable|string|max:100',
            'serie'           => 'nullable|string|max:100|unique:equipos,serie',
            'codigo'          => 'nullable|string|max:100|unique:equipos,codigo',
            'caracteristicas' => 'nullable|string|max:255',
            'estado'          => 'required|in:Disponible,Asignado,En Reparación,Dañado',
        ]);

        Equipo::create($request->only([
            'tipo','marca','modelo','serie','codigo','caracteristicas','estado'
        ]));

        // redirige a la lista del tipo registrado
        return redirect()->route('equipos.'.strtolower($request->tipo))
            ->with('success', 'Equipo registrado correctamente.');
    }

    // Listados por tipo (ya los tenías)
    public function cpu()    { return $this->listado('CPU',    'equipos.cpu'); }
    public function monitor(){ return $this->listado('Monitor','equipos.monitor'); }
    public function teclado(){ return $this->listado('Teclado','equipos.teclado'); }
    public function mouse()  { return $this->listado('Mouse',  'equipos.mouse'); }

    private function listado($tipo, $view)
    {
        $equipos = Equipo::where('tipo',$tipo)->orderBy('estado')->orderBy('marca')->get();
        return view($view, compact('equipos','tipo'));
    }
}
