@extends('adminlte::page')

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

        @if ($errors->any())
            <div class="alert alert-danger m-3">
                <ul>
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('equipos.update', $equipo->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">

                <!-- Tipo -->
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <select name="tipo" id="tipo" class="form-control" onchange="mostrarCampos()">
                        @foreach($tipos as $t)
                            <option value="{{ $t }}" {{ $equipo->tipo == $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Campos comunes -->
                <div class="form-group campo-cpu" id="campo-tipo-cpu">
                    <label for="tipo_cpu">CPU Tipo</label>
                    <select name="tipo_cpu" class="form-control">
                        <option value="Desktop">Desktop</option>
                        <option value="Laptop">Laptop</option>
                    </select>
                </div>

                <div class="form-group campo-monitor-cpu" id="campo-marca">
                    <label>Marca</label>
                    <input type="text" name="marca" class="form-control" value="{{ $equipo->marca }}">
                </div>

                <div class="form-group campo-monitor-cpu" id="campo-modelo">
                    <label>Modelo</label>
                    <input type="text" name="modelo" class="form-control" value="{{ $equipo->modelo }}">
                </div>

                <div class="form-group campo-todos" id="campo-serial">
                    <label>Serial</label>
                    <input type="text" name="serial" class="form-control" value="{{ $equipo->serial }}">
                </div>

                <div class="form-group campo-cpu" id="campo-mainboard-marca">
                    <label>Mainboard Marca</label>
                    <input type="text" name="mainboard_marca" class="form-control" value="{{ $equipo->mainboard_marca }}">
                </div>

                <div class="form-group campo-cpu" id="campo-mainboard-modelo">
                    <label>Mainboard Modelo</label>
                    <input type="text" name="mainboard_modelo" class="form-control" value="{{ $equipo->mainboard_modelo }}">
                </div>

                <div class="form-group campo-cpu" id="campo-procesador">
                    <label>Procesador</label>
                    <input type="text" name="procesador" class="form-control" value="{{ $equipo->procesador }}">
                </div>

                <div class="form-group campo-cpu" id="campo-ram">
                    <label>Memoria RAM (GB)</label>
                    <input type="number" name="memoria_ram" class="form-control" value="{{ $equipo->memoria_ram }}">
                </div>

                <div class="form-group campo-cpu" id="campo-disco">
                    <label>Capacidad Disco</label>
                    <input type="text" name="capacidad_disco" class="form-control" value="{{ $equipo->capacidad_disco }}">
                </div>

                <div class="form-group campo-monitor" id="campo-energia">
                    <label>Energía</label>
                    <input type="text" name="energia" class="form-control" value="{{ $equipo->energia }}">
                </div>

                <!-- Estado -->
                <div class="form-group">
                    <label>Estado</label>
                    <select name="estado" class="form-control" onchange="cambiarColor()">
                        @foreach($estados as $e)
                            <option value="{{ $e }}" {{ $equipo->estado == $e ? 'selected' : '' }}>{{ $e }}</option>
                        @endforeach
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
function mostrarCampos() {
    const tipo = document.getElementById('tipo').value;

    // Ocultar todos
    document.querySelectorAll('.campo-cpu, .campo-monitor, .campo-monitor-cpu, .campo-todos').forEach(el => el.style.display = 'none');

    if(tipo == 'CPU') {
        document.querySelectorAll('.campo-cpu, .campo-monitor-cpu, .campo-todos').forEach(el => el.style.display = 'block');
    } else if(tipo == 'Monitor') {
        document.querySelectorAll('.campo-monitor, .campo-monitor-cpu, .campo-todos').forEach(el => el.style.display = 'block');
    } else if(tipo == 'Teclado' || tipo == 'Mouse') {
        document.querySelectorAll('.campo-todos').forEach(el => el.style.display = 'block');
    }
}

function cambiarColor() {
    const estado = document.querySelector('select[name="estado"]').value;
    const select = document.querySelector('select[name="estado"]');
    switch(estado){
        case 'Disponible': select.style.backgroundColor = '#d4edda'; break;
        case 'Asignado': select.style.backgroundColor = '#fff3cd'; break;
        case 'En Reparación': select.style.backgroundColor = '#ffe5b4'; break;
        case 'Dañado': select.style.backgroundColor = '#f8d7da'; break;
        case 'Obsoleto': select.style.backgroundColor = '#e2e3e5'; break;
        case 'Dado de Baja': select.style.backgroundColor = '#d6d8d9'; break;
        default: select.style.backgroundColor = 'white';
    }
}

// Ejecutar al cargar la página
document.addEventListener('DOMContentLoaded', () => {
    mostrarCampos();
    cambiarColor();
});
</script>
@stop
