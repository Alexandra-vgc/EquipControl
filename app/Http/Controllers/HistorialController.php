<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use Illuminate\Http\Request;

class HistorialController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:ver-historial']);
    }

    // 🔹 Mostrar historial con búsqueda y filtros
    public function index(Request $request)
    {
        $query = Historial::with(['equipo', 'usuario'])->orderBy('created_at', 'desc');

        // 🔎 Buscador general
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('equipo', function($q2) use ($search) {
                    if (\Schema::hasColumn('equipos', 'codigo')) {
                        $q2->where('codigo', 'like', "%$search%");
                    }
                    if (\Schema::hasColumn('equipos', 'nombre')) {
                        $q2->orWhere('nombre', 'like', "%$search%");
                    }
                })
                ->orWhereHas('usuario', fn($q2) => $q2->where('name', 'like', "%$search%"))
                ->orWhere('accion', 'like', "%$search%")
                ->orWhere('observaciones', 'like', "%$search%");
            });
        }

        // 🔽 Filtrar por rol usando la relación usuario->roles (Spatie)
        if ($request->filled('rol')) {
            $rol = $request->rol;
            $query->whereHas('usuario.roles', fn($q) => $q->where('name', $rol));
        }

        // 🔽 Filtrar por fecha exacta
        if ($request->filled('fecha')) {
            $query->whereDate('created_at', $request->fecha);
        }

        $historiales = $query->paginate(15)->withQueryString();

        return view('historial.index', compact('historiales'));
    }

    // ✅ Eliminar historial vía AJAX
    public function destroy($id)
    {
        try {
            $historial = Historial::findOrFail($id);
            $historial->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el historial.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
