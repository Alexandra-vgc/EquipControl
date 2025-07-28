@extends('layouts.app')

@section('content')
    <h1>Bienvenido Lector</h1>
    <p>Solo tienes acceso lectura.</p>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Cerrar sesión
    </a>
@endsection
