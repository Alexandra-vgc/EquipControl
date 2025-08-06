@extends('adminlte::page')

@section('title', 'Editar Solicitud')

@section('content_header')
    <h1>Editar Solicitud</h1>
@stop

@section('content')
    <form action="{{ route('admin.solicitudes.update', $solicitud->id) }}" method="POST">
    @csrf
    @method('PUT')
    
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="{{ old('nombre', $solicitud->nombre) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Apellido:</label>
            <input type="text" name="apellido" value="{{ old('apellido', $solicitud->apellido) }}" class="form-control" required>
        </div>

       <div class="form-group">
        <label for="estado">Estado:</label>
        <select name="estado" class="form-control" required>
            <option value="pendiente" {{ $solicitud->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="aprobado" {{ $solicitud->estado == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
            <option value="negado" {{ $solicitud->estado == 'negado' ? 'selected' : '' }}>Negado</option>
        </select>
    </div>

        <button type="submit" class="btn btn-primary">Actualizar Solicitud</button>
    </form>
@stop
