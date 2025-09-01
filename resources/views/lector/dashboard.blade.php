@extends('adminlte::page')

@section('title', 'Panel Lector')

@section('content_header')
    <h1>Bienvenido, Lector</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <x-adminlte-card title="Información del Instituto" theme="primary" icon="fas fa-university">
                <p><strong>Nombre:</strong> Instituto Superior Tecnológico Ejemplo</p>
                <p><strong>Dirección:</strong> Av. Siempre Viva 123, Ciudad</p>
                <p><strong>Teléfono:</strong> (02) 555-1234</p>
                <p><strong>Email:</strong> contacto@instituto.edu.ec</p>
            </x-adminlte-card>
        </div>

        <div class="col-md-6">
            <x-adminlte-card title="Contáctanos" theme="info" icon="fas fa-envelope">
                <p>Si necesitas más información, puedes escribirnos:</p>
                <ul>
                    <li>WhatsApp: +593 987654321</li>
                    <li>Correo: soporte@instituto.edu.ec</li>
                </ul>
            </x-adminlte-card>
        </div>
    </div>
@stop

@section('footer')
    <div class="text-center">
        <small>&copy; {{ date('Y') }} Instituto Superior Tecnológico Ejemplo</small>
    </div>
@stop
