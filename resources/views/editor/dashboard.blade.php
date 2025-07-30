@extends('layouts.app')

@section('content')
    <h1>Bienvenido Editor</h1>
    <h1>HOLA MUNDO</h1>
    <p>Este es el panel para editar contenido.</p>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Cerrar sesión
    </a>
@endsection
