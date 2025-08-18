<!-- resources/views/equipos/edit.blade.php -->

@extends('adminlte::page') <!-- Extiende la plantilla de AdminLTE -->

@section('title', 'Editar Equipo')

@section('content_header')
    <h1>Editar Equipo</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Formulario de Edición</h3>
        </div>

        <!-- Mostrar errores -->
        @if ($errors->any())
            <div class="alert alert-danger m-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario -->
        <form action="{{ route('equipos.update', $equipo->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">

                <!-- Tipo -->
                <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <select name="tipo" id="tipo" class="form-control select2" style="width: 100%;">
                            <option value="CPU" {{ $equipo->tipo == 'CPU' ? 'selected' : '' }}>CPU</option>
                            <option value="Monitor" {{ $equipo->tipo == 'Monitor' ? 'selected' : '' }}>Monitor</option>
                            <option value="Teclado" {{ $equipo->tipo == 'Teclado' ? 'selected' : '' }}>Teclado</option>
                            <option value="Mouse" {{ $equipo->tipo == 'Mouse' ? 'selected' : '' }}>Mouse</option>
                    </select>
                </div>

                <!-- Marca -->
                <div class="form-group">
                    <label for="marca">Marca</label>
                    <input type="text" name="marca" class="form-control" value="{{ $equipo->marca }}" placeholder="Marca del equipo">
                </div>

                <!-- Modelo -->
                <div class="form-group">
                    <label for="modelo">Modelo</label>
                    <input type="text" name="modelo" class="form-control" value="{{ $equipo->modelo }}" placeholder="Modelo del equipo">
                </div>

                <!-- Serie -->
                <div class="form-group">
                    <label for="serie">Serie</label>
                    <input type="text" name="serie" class="form-control" value="{{ $equipo->serie }}" placeholder="Número de serie">
                </div>

                <!-- Código -->
                <div class="form-group">
                    <label for="codigo">Código</label>
                    <input type="text" name="codigo" class="form-control" value="{{ $equipo->codigo }}" placeholder="Código interno">
                </div>

                <!-- Características -->
                <div class="form-group">
                    <label for="caracteristicas">Características</label>
                    <textarea name="caracteristicas" class="form-control" rows="3" placeholder="Características">{{ $equipo->caracteristicas }}</textarea>
                </div>

                <!-- Estado -->
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado" class="form-control" onchange="cambiarColor()">
                            <option value="Disponible" {{ $equipo->estado == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                            <option value="Asignado" {{ $equipo->estado == 'Asignado' ? 'selected' : '' }}>Asignado</option>
                            <option value="En Reparación" {{ $equipo->estado == 'En Reparación' ? 'selected' : '' }}>En Reparación</option>
                            <option value="Dañado" {{ $equipo->estado == 'Dañado' ? 'selected' : '' }}>Dañado</option>
                    </select>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success">Actualizar Equipo</button>
                <a href="{{ route('equipos.inventario') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@stop

@section('js')
<script>
    function cambiarColor() {
        const estado = document.getElementById('estado').value;
        const select = document.getElementById('estado');
        switch(estado){
            case 'Disponible': select.style.backgroundColor = '#d4edda'; break; // verde claro
            case 'Asignado': select.style.backgroundColor = '#fff3cd'; break; // amarillo
            case 'En Reparación': select.style.backgroundColor = '#ffe5b4'; break; // naranja claro
            case 'Dañado': select.style.backgroundColor = '#f8d7da'; break; // rojo claro
            case 'Obsoleto': select.style.backgroundColor = '#e2e3e5'; break; // gris
            case 'Dado de Baja': select.style.backgroundColor = '#d6d8d9'; break; // gris oscuro
            default: select.style.backgroundColor = 'white';
        }
    }

    // Ejecutar al cargar la página
    document.addEventListener('DOMContentLoaded', cambiarColor);
</script>
@stop
