<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Exception;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email',
            'mensaje' => 'required|string',
        ]);

        try {
            // Usar ContactMail en lugar de Mail::send()
            Mail::to(env('MAIL_FROM_ADDRESS', 'alexandraguaranda59@gmail.com'))
                ->send(new ContactMail(
                    $request->nombre,
                    $request->correo, 
                    $request->mensaje
                ));

            return redirect()->back()->with('success', 'Mensaje enviado correctamente.');
            
        } catch (Exception $e) {
            \Log::error('Error enviando email de contacto: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al enviar el mensaje. Intenta nuevamente.');
        }
    }
}