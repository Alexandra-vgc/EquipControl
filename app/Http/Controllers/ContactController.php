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
            // Forzamos que siempre haya un from válido
            $message->from(env('MAIL_FROM_ADDRESS', 'alexandraguaranda59@gmail.com'), env('MAIL_FROM_NAME', 'EquipControl'));
            $message->to(env('MAIL_FROM_ADDRESS', 'alexandraguaranda59@gmail.com'))
                    ->subject('Nuevo mensaje de contacto')
                    ->replyTo($data['correo'], $data['nombre']);
        });

        return redirect()->back()->with('success', 'Mensaje enviado correctamente.');
    }
}

