<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pdf;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    // Mostrar PDFs y buscador
    public function index(Request $request)
    {
        $query = Pdf::query();

        if($request->filled('nombre')){
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        $pdfs = $query->get();

        return view('pdfs.index', compact('pdfs'));
    }

    // Guardar PDF
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'archivo' => 'required|file|mimes:pdf|max:2048',
        ]);

        $path = $request->file('archivo')->store('pdfs', 'public');

        Pdf::create([
            'nombre' => $request->nombre,
            'archivo' => $path,
        ]);

        return redirect()->back()->with('success', 'PDF guardado correctamente.');
    }

    // 🔹 Buscar PDF por nombre (para tu card en crear entrega)
    public function buscar(Request $request)
    {
        $nombre = $request->get('nombre');

        $pdfs = Pdf::where('nombre', 'like', "%{$nombre}%")->get();

        // Retorna JSON para que puedas usar AJAX o simplemente un foreach en blade
        return response()->json($pdfs);
    }
}
