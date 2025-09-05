<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;  // Cambiado para que coincida con tu vista
    public $correo;  // Cambiado para que coincida con tu vista
    public $mensaje; // Cambiado para que coincida con tu vista

    public function __construct($nombre, $correo, $mensaje)
    {
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->mensaje = $mensaje;
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->subject('Nuevo mensaje de contacto')
                    ->replyTo($this->correo, $this->nombre)  // Para poder responder al remitente
                    ->view('emails.contact');  // Cambiado de markdown() a view()
    }
}