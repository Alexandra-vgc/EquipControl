@extends('layouts.app')

@section('content')
    <h1>Bienvenido Admin</h1>
    <p>Este es el panel de administración.</p>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Cerrar sesión
    </a>
@endsection
