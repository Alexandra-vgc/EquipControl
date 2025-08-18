<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;

class EquipoController extends Controller
{
    // 🔹 Método para mostrar el inventario general (tu método actual mejorado)
    public function inventario()
    {
        $equipos = Equipo::orderBy('tipo')->orderBy('estado')->get();
        return view('equipos.inventario', compact('equipos'));
    }

    // 🔹 Método para mostrar el formulario de crear equipo (tu método actual)
    public function create()
    {
        $tipos = ['CPU','Monitor','Teclado','Mouse'];
        $estados = ['Disponible','Asignado','En Reparación','Dañado'];
        return view('equipos.create', compact('tipos', 'estados'));
    }

    // 🔹 Método para guardar equipo (tu método actual mejorado)
    public function store(Request $request)
    {
        $request->validate([
            'tipo'            => 'required|in:CPU,Monitor,Teclado,Mouse,Impresora,Laptop,Tablet,Router,Switch,UPS,Proyector,Otros',
            'marca'           => 'nullable|string|max:100',
            'modelo'          => 'nullable|string|max:100',
            'serie'           => 'nullable|string|max:100|unique:equipos,serie',
            'codigo'          => 'nullable|string|max:100|unique:equipos,codigo',
            'caracteristicas' => 'nullable|string|max:255',
            'estado'          => 'required|in:Disponible,Asignado,En Reparación,Dañado,Obsoleto,Dado de Baja',
        ]);

        Equipo::create($request->only([
            'tipo','marca','modelo','serie','codigo','caracteristicas','estado'
        ]));

        return redirect()->route('equipos.inventario')
            ->with('success', 'Equipo registrado correctamente.');
    }

    // 🔹 NUEVOS MÉTODOS que agregamos:

    // Mostrar un equipo específico
    public function show($id)
    {
        $equipo = Equipo::findOrFail($id);
        return view('equipos.show', compact('equipo'));
    }

    // Mostrar formulario para editar
    public function edit($id)
    {
        $equipo = Equipo::findOrFail($id);
        $tipos = ['CPU','Monitor','Teclado','Mouse','Impresora','Laptop','Tablet','Router','Switch','UPS','Proyector','Otros'];
        $estados = ['Disponible','Asignado','En Reparación','Dañado','Obsoleto','Dado de Baja'];
        return view('equipos.edit', compact('equipo', 'tipos', 'estados'));
    }

    // Actualizar equipo
    public function update(Request $request, $id)
    {
        $equipo = Equipo::findOrFail($id);
        
        $request->validate([
            'tipo'            => 'required|in:CPU,Monitor,Teclado,Mouse,Impresora,Laptop,Tablet,Router,Switch,UPS,Proyector,Otros',
            'marca'           => 'nullable|string|max:100',
            'modelo'          => 'nullable|string|max:100',
            'serie'           => 'nullable|string|max:100|unique:equipos,serie,' . $id,
            'codigo'          => 'nullable|string|max:100|unique:equipos,codigo,' . $id,
            'caracteristicas' => 'nullable|string|max:255',
            'estado'          => 'required|in:Disponible,Asignado,En Reparación,Dañado,Obsoleto,Dado de Baja',
        ]);

        $equipo->update($request->only([
            'tipo','marca','modelo','serie','codigo','caracteristicas','estado'
        ]));

        return redirect()->route('equipos.inventario')
            ->with('success', 'Equipo actualizado correctamente.');
    }

    // 🔹 NUEVO: Eliminar equipo (el que necesitas)
    public function destroy($id)
    {
        try {
            $equipo = Equipo::findOrFail($id);
            $equipo->delete();
            
            return redirect()->route('equipos.inventario')
                ->with('success', 'Equipo eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('equipos.inventario')
                ->with('error', 'Error al eliminar el equipo. Inténtalo nuevamente.');
        }
    }
}