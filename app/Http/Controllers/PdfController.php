<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pdf;
use App\Models\Asignacion;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;

class PdfController extends Controller
{
    // Guardar PDF subido manualmente o desde base64
    public function store(Request $request)
    {
        // Tomar el nombre del último registro en asignaciones
        $ultimaAsignacion = Asignacion::latest()->first();
        $nombreColaborador = preg_replace('/[^A-Za-z0-9]/', '', str_replace(' ', '_', $ultimaAsignacion->nombre));

        // Si viene archivo subido
        if ($request->hasFile('archivo')) {
            $request->validate([
                'archivo' => 'required|file|mimes:pdf|max:2048',
            ]);

            $extension = $request->file('archivo')->getClientOriginalExtension();
            $fileName = $nombreColaborador . '.' . $extension;
            $path = $request->file('archivo')->storeAs('pdfs', $fileName, 'public');

            Pdf::create([
                'nombre' => $fileName,
                'archivo' => $path,
            ]);

            return redirect()->back()->with('success', 'PDF guardado correctamente.');
        }

        // Si viene PDF en base64
        $request->validate([
            'pdf_base64' => 'required|string',
        ]);

        $fileName = $nombreColaborador . '.pdf';
        $pdfContent = base64_decode($request->pdf_base64);
        $filePath = 'pdfs/' . $fileName;

        Storage::disk('public')->put($filePath, $pdfContent);

        Pdf::create([
            'nombre' => $fileName,
            'archivo' => $filePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'PDF guardado correctamente',
            'pdf_id' => Pdf::latest()->first()->id,
        ]);
    }

    // Generar PDF desde asignación (botón "Guardar PDF")
    public function generarPdf(Request $request)
    {
        $request->validate([
            'asignacion_id' => 'required|exists:asignaciones,id',
        ]);

        $asignacion = Asignacion::with(['detalles.equipo'])->findOrFail($request->asignacion_id);
        $pdf = DomPDF::loadView('pdf', compact('asignacion'));

        $nombreColaborador = preg_replace('/[^A-Za-z0-9]/', '', str_replace(' ', '_', $asignacion->nombre));
        $fileName = $nombreColaborador . '.pdf';
        $filePath = 'pdfs/' . $fileName;

        Storage::disk('public')->put($filePath, $pdf->output());

        Pdf::create([
            'nombre' => $fileName,
            'archivo' => $filePath,
        ]);

        return redirect()->route('entregas.create')
                         ->with('success', 'PDF generado y guardado correctamente.');
    }
    public function buscar(Request $request)
    {
        $nombre = $request->get('nombre');

        $pdfs = Pdf::where('nombre', 'like', "%{$nombre}%")->get();

        return response()->json($pdfs);
    }
}
