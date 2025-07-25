<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        $data = [
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'mensaje' => $request->mensaje,
        ];

        Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->to('contacto@equipcontrol.com')
                    ->subject('Nuevo mensaje de contacto');
        });

        return redirect()->back()->with('success', 'Mensaje enviado correctamente (simulado).');
    }
}