@extends('adminlte::page')

@section('title', 'Asignar Rol')

@section('content_header')
    <h1>Asignar Rol a Usuario</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.usuario.asignar') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="user_id">Usuario</label>
            <select name="user_id" class="form-control">
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name }} ({{ $usuario->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="rol">Rol</label>
            <select name="rol" class="form-control">
                @foreach($roles as $rol)
                    <option value="{{ $rol->name }}">{{ ucfirst($rol->name) }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Asignar Rol</button>
    </form>
@stop
