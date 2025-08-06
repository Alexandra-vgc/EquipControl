@extends('adminlte::page')

@section('title', 'Nueva Solicitud')

@section('content_header')
    <h1>Crear nueva solicitud</h1>
@stop

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.solicitudes.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Nombre:</label>
        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
    </div>

    <div class="form-group">
        <label>Apellido:</label>
        <input type="text" name="apellido" class="form-control" value="{{ old('apellido') }}" required>
    </div>

    <div class="form-group">
        <label>Estado:</label>
        <select name="estado" class="form-control" required>
            <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="aprobado" {{ old('estado') == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
            <option value="negado" {{ old('estado') == 'negado' ? 'selected' : '' }}>Negado</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Guardar Solicitud</button>
    <a href="{{ route('admin.solicitudes.index') }}" class="btn btn-secondary">Cancelar</a>
</form>

@stop
