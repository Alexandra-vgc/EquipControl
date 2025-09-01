@extends('adminlte::page')

@section('title', 'EquipControl - Vista 2')

@section('content_header')
<h1 class="mb-1">
    <i class="fas fa-cogs text-primary"></i> Detalles Técnicos del Equipo
</h1>
@stop

@section('content')
<form action="{{ route('asignaciones.guardarDetalles') }}" method="POST">
    @csrf
    <input type="hidden" name="asignacion_id" value="{{ $asignacion->id }}">

    <!-- Primera fila de 4 columnas -->
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow mb-3">
                <div class="card-header bg-light">
                    <strong>Tarjeta de red</strong>
                </div>
                <div class="card-body">
                    <label><input type="checkbox" name="tarjeta_red[]" value="Ethernet"> Ethernet</label><br>
                    <label><input type="checkbox" name="tarjeta_red[]" value="WiFi"> WiFi</label>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow mb-3">
                <div class="card-header bg-light">
                    <strong>Parlantes</strong>
                </div>
                <div class="card-body">
                    <label><input type="checkbox" name="parlantes[]" value="Si"> Sí</label><br>
                    <label><input type="checkbox" name="parlantes[]" value="No"> No</label>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow mb-3">
                <div class="card-header bg-light">
                    <strong>Tarjeta de video</strong>
                </div>
                <div class="card-body">
                    <label><input type="checkbox" name="tarjeta_video[]" value="Interna"> Interna</label><br>
                    <label><input type="checkbox" name="tarjeta_video[]" value="Externa"> Externa</label>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow mb-3">
                <div class="card-header bg-light">
                    <strong>Tarjeta de audio</strong>
                </div>
                <div class="card-body">
                    <label><input type="checkbox" name="tarjeta_audio[]" value="Interna"> Interna</label><br>
                    <label><input type="checkbox" name="tarjeta_audio[]" value="Externa"> Externa</label>
                </div>
            </div>
        </div>
    </div>

    <!-- Segunda fila de 4 columnas -->
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow mb-3">
                <div class="card-header bg-light">
                    <strong>Dispositivo Óptico</strong>
                </div>
                <div class="card-body">
                    <label><input type="checkbox" name="optico[]" value="CD"> CD</label><br>
                    <label><input type="checkbox" name="optico[]" value="DVD"> DVD</label><br>
                    <label><input type="checkbox" name="optico[]" value="Writer"> Writer</label>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow mb-3">
                <div class="card-header bg-light">
                    <strong>Multilector SD</strong>
                </div>
                <div class="card-body">
                    <label><input type="checkbox" name="sd[]" value="Si"> Sí</label><br>
                    <label><input type="checkbox" name="sd[]" value="No"> No</label>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow mb-3">
                <div class="card-header bg-light">
                    <strong>Teléfono Serial</strong>
                </div>
                <div class="card-body">
                    <input type="text" name="telefono_serial" class="form-control">
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow mb-3">
                <div class="card-header bg-light">
                    <strong>IP</strong>
                </div>
                <div class="card-body">
                    <input type="text" name="ip" class="form-control">
                </div>
            </div>
        </div>
    </div>

    <!-- Otros -->
    <div class="card shadow mb-3">
        <div class="card-header bg-light">
            <strong>Otros</strong>
        </div>
        <div class="card-body">
            <input type="text" name="otros" class="form-control">
        </div>
    </div>

    <!-- Tabla Otros Dispositivos -->
    <div class="card shadow mb-3">
        <div class="card-header bg-light">
            <strong>Otros Dispositivos</strong>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Tipo</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Serial</th>
                        <th>Observación</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 3; $i++)
                    <tr>
                        <td><input type="text" name="otros_dispositivos[{{ $i }}][tipo]" class="form-control"></td>
                        <td><input type="text" name="otros_dispositivos[{{ $i }}][marca]" class="form-control"></td>
                        <td><input type="text" name="otros_dispositivos[{{ $i }}][modelo]" class="form-control"></td>
                        <td><input type="text" name="otros_dispositivos[{{ $i }}][serial]" class="form-control"></td>
                        <td><input type="text" name="otros_dispositivos[{{ $i }}][observacion]" class="form-control"></td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>

    <!-- Botones -->
    <div class="d-flex justify-content-between mt-4">
        <!-- Botón Atrás (lleva a entregas.create) -->
        <a href="{{ route('entregas.create') }}" class="btn btn-secondary btn-lg shadow">
            <i class="fas fa-arrow-left"></i> Atrás
        </a>

        <!-- Botón Guardar -->
        <button type="submit" class="btn btn-success btn-lg shadow">
            <i class="fas fa-save"></i> Guardar y Siguiente
        </button>
    </div>
</form>
@stop
