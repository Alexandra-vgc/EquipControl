@extends('adminlte::page')

@section('title', 'Solicitudes de Entrega')

@section('content_header')
    <h1>Solicitudes de Entrega</h1>
@stop

@section('content')
    {{-- Botón para nueva solicitud --}}
    <div class="mb-3 text-right">
        <a href="{{ route('admin.solicitudes.create') }}" class="btn btn-success">Nueva Solicitud</a>
    </div>

    {{-- Formulario de búsqueda --}}
    <form method="GET" action="{{ route('admin.solicitudes.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre o apellido" value="{{ $busqueda }}">
            <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
        </div>
    </form>

    {{-- Tabla de solicitudes --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($solicitudes as $solicitud)
                 <tr>
                    <td>{{ $solicitud->nombre }}</td>
                    <td>{{ $solicitud->apellido }}</td>
                    <td>
                        @php
                        $estado = strtolower($solicitud->estado);
                        @endphp
                        @if($estado == 'aprobado')
                            <span class="badge bg-success">Aprobado</span>
                        @elseif($estado == 'negado')
                            <span class="badge bg-danger">Negado</span>
                        @else
                            <span class="badge bg-warning text-dark">Pendiente</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.solicitudes.edit', $solicitud) }}" class="btn btn-sm btn-primary">Editar</a>
                        <form action="{{ route('admin.solicitudes.destroy', $solicitud) }}" method="POST" style="display:inline">
                            @csrf 
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar solicitud?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
