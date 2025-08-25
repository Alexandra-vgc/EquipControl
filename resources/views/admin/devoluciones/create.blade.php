@extends('adminlte::page')

@section('title','Registrar Devolución')

@section('content_header') 
    <h1>Registrar Devolución</h1> 
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.devoluciones.store') }}" method="POST">


    @csrf

    <div class="row mb-3">
        <div class="col-md-4">
            <label>Usuario</label>
            <select name="user_id" class="form-control" required>
                @foreach($usuarios as $u)
                    <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label>Equipo</label>
            <select name="equipo_id" class="form-control" required>
                @foreach($equipos as $e)
                    <option value="{{ $e->id }}">
                        {{ trim("{$e->tipo} {$e->marca} {$e->modelo} {$e->serie}") ?: ($e->codigo ?? $e->id) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label>Fecha de Devolución</label>
            <input type="date" name="fecha_devolucion" class="form-control" required>
        </div>
    </div>

    <div class="mb-3">
        <label>Observaciones</label>
        <input type="text" name="observaciones" class="form-control">
    </div>

    <button class="btn btn-primary mt-2">Guardar Devolución</button>
</form>

@stop

