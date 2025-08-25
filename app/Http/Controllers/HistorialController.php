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

    public function index(Request $request)
    {
        $query = Historial::with(['equipo', 'usuario'])->orderBy('created_at', 'desc');

        if ($request->filled('equipo_id')) {
            $query->where('equipo_id', $request->equipo_id);
        }
        if ($request->filled('usuario_id')) {
            $query->where('usuario_id', $request->usuario_id);
        }
        if ($request->filled('accion')) {
            $query->where('accion', $request->accion);
        }
        if ($request->filled('desde')) {
            $query->whereDate('created_at', '>=', $request->desde);
        }
        if ($request->filled('hasta')) {
            $query->whereDate('created_at', '<=', $request->hasta);
        }

        $historiales = $query->paginate(15)->withQueryString();

        return view('historial.index', compact('historiales'));
    }
}