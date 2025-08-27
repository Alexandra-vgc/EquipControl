<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;

class EquipoController extends Controller
{
    // 🔹 Mostrar inventario
    public function inventario()
    {
        $equipos = Equipo::orderBy('tipo')->orderBy('estado')->get();
        return view('equipos.inventario', compact('equipos'));
    }

    // 🔹 Formulario para crear equipo
    public function create()
    {
        $tipos = ['CPU','Monitor','Teclado','Mouse'];
        $estados = ['Disponible','Asignado','En Reparación','Dañado'];
        return view('equipos.create', compact('tipos', 'estados'));
    }

    // 🔹 Guardar equipo
    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:CPU,Monitor,Teclado,Mouse',
            'estado' => 'required|in:Disponible,Asignado,En Reparación,Dañado',
            // Campos dinámicos según tipo
            'tipo_cpu'        => 'nullable|in:Desktop,Laptop',
            'marca'           => 'nullable|string|max:100',
            'modelo'          => 'nullable|string|max:100',
            'serial'          => 'nullable|string|max:100|unique:equipos,serial',
            'mainboard_marca' => 'nullable|string|max:100',
            'mainboard_modelo'=> 'nullable|string|max:100',
            'procesador'      => 'nullable|string|max:100',
            'memoria_ram'     => 'nullable|integer',
            'capacidad_disco' => 'nullable|string|max:50',
            'energia'         => 'nullable|string|max:50',
        ]);

        $data = [
            'tipo' => $request->tipo,
            'estado' => $request->estado,
        ];

        switch($request->tipo){
            case 'CPU':
                $data['tipo_cpu'] = $request->tipo_cpu;
                $data['marca'] = $request->marca;
                $data['modelo'] = $request->modelo;
                $data['serial'] = $request->serial;
                $data['mainboard_marca'] = $request->mainboard_marca;
                $data['mainboard_modelo'] = $request->mainboard_modelo;
                $data['procesador'] = $request->procesador;
                $data['memoria_ram'] = $request->memoria_ram;
                $data['capacidad_disco'] = $request->capacidad_disco;
                break;

            case 'Monitor':
                $data['marca'] = $request->marca_monitor;
                $data['modelo'] = $request->modelo_monitor;
                $data['serial'] = $request->serial_monitor;
                $data['energia'] = $request->energia;
                break;

            case 'Teclado':
            case 'Mouse':
                $data['serial'] = $request->serial_simple;
                break;
        }

        Equipo::create($data);

        return redirect()->route('equipos.inventario')
            ->with('success', 'Equipo registrado correctamente.');
    }

    // 🔹 Mostrar equipo
    public function show($id)
    {
        $equipo = Equipo::findOrFail($id);
        return view('equipos.show', compact('equipo'));
    }

    // 🔹 Formulario para editar
    public function edit($id)
    {
        $equipo = Equipo::findOrFail($id);
        $tipos = ['CPU','Monitor','Teclado','Mouse'];
        $estados = ['Disponible','Asignado','En Reparación','Dañado'];
        return view('equipos.edit', compact('equipo', 'tipos', 'estados'));
    }

    // 🔹 Actualizar equipo
    public function update(Request $request, $id)
    {
        $equipo = Equipo::findOrFail($id);

        $request->validate([
            'tipo' => 'required|in:CPU,Monitor,Teclado,Mouse',
            'estado' => 'required|in:Disponible,Asignado,En Reparación,Dañado',
            'tipo_cpu'        => 'nullable|in:Desktop,Laptop',
            'marca'           => 'nullable|string|max:100',
            'modelo'          => 'nullable|string|max:100',
            'serial'          => 'nullable|string|max:100|unique:equipos,serial,' . $id,
            'mainboard_marca' => 'nullable|string|max:100',
            'mainboard_modelo'=> 'nullable|string|max:100',
            'procesador'      => 'nullable|string|max:100',
            'memoria_ram'     => 'nullable|integer',
            'capacidad_disco' => 'nullable|string|max:50',
            'energia'         => 'nullable|string|max:50',
        ]);

        $data = [
            'tipo' => $request->tipo,
            'estado' => $request->estado,
        ];

        switch($request->tipo){
            case 'CPU':
                $data['tipo_cpu'] = $request->tipo_cpu;
                $data['marca'] = $request->marca;
                $data['modelo'] = $request->modelo;
                $data['serial'] = $request->serial;
                $data['mainboard_marca'] = $request->mainboard_marca;
                $data['mainboard_modelo'] = $request->mainboard_modelo;
                $data['procesador'] = $request->procesador;
                $data['memoria_ram'] = $request->memoria_ram;
                $data['capacidad_disco'] = $request->capacidad_disco;
                break;

            case 'Monitor':
                $data['marca'] = $request->marca_monitor;
                $data['modelo'] = $request->modelo_monitor;
                $data['serial'] = $request->serial_monitor;
                $data['energia'] = $request->energia;
                break;

            case 'Teclado':
            case 'Mouse':
                $data['serial'] = $request->serial_simple;
                break;
        }

        $equipo->update($data);

        return redirect()->route('equipos.inventario')
            ->with('success', 'Equipo actualizado correctamente.');
    }

    // 🔹 Eliminar equipo
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
