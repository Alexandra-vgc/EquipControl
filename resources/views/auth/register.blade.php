@extends('adminlte::auth.register')

@section('auth_body')
<form action="{{ url('/register') }}" method="POST">
    @csrf

    {{-- Nombre --}}
    <div class="input-group mb-3">
        <input type="text" name="name" class="form-control" placeholder="Nombre completo" required autofocus>
        <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-user"></span></div>
        </div>
    </div>

    {{-- Correo --}}
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required>
        <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
        </div>
    </div>

    {{-- Contraseña --}}
    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
        <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
        </div>
    </div>

    {{-- Confirmación contraseña --}}
    <div class="input-group mb-3">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar contraseña" required>
        <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
        </div>
    </div>

    <button type="submit" class="btn btn-success btn-block">Registrarse</button>
</form>

<p class="mt-3 mb-1 text-center">
    <a href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión</a>
</p>
@endsection
