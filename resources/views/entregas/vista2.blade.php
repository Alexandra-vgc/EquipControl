@extends('adminlte::page')

@section('title', 'EquipControl - Vista 2')

@section('content_header')
<h1 class="mb-1">
    <i class="fas fa-cogs text-primary"></i> Detalles Técnicos del Equipo
</h1>
@stop

@section('content')
<form action="{{ route('asignaciones.guardarDetalles') }}" method="POST" enctype="multipart/form-data">
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

    <!-- Uso del Equipo -->
    <div class="card shadow mb-3">
        <div class="card-header bg-light">
            <strong>Uso del Equipo</strong>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Laboratorio</th>
                        <th>Coordinación</th>
                        <th>Biblioteca</th>
                        <th>Administrativo</th>
                        <th>Investigador</th>
                        <th>Docente</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox" name="uso_equipo[]" value="Laboratorio"></td>
                        <td><input type="checkbox" name="uso_equipo[]" value="Coordinacion"></td>
                        <td><input type="checkbox" name="uso_equipo[]" value="Biblioteca"></td>
                        <td><input type="checkbox" name="uso_equipo[]" value="Administrativo"></td>
                        <td><input type="checkbox" name="uso_equipo[]" value="Investigador"></td>
                        <td><input type="checkbox" name="uso_equipo[]" value="Docente"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Verificación Funcional -->
    <div class="card shadow mb-3">
        <div class="card-header bg-light">
            <strong>Verificación Funcional</strong>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Comprobar encendido y apagado correcto</th>
                        <th>Funcionamiento de periféricos: mouse, teclado y parlantes</th>
                        <th>Funcionamiento básico del Sistema operativo Windows o Linux</th>
                        <th>Verificación de las particiones C: D: del disco duro</th>
                        <th>Correcto funcionamiento de software instalado</th>
                        <th>Correcto funcionamiento del monitor</th>
                        <th>Correcta conexión con la red</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox" name="verificacion_funcional[]" value="EncendidoApagado"></td>
                        <td><input type="checkbox" name="verificacion_funcional[]" value="Perifericos"></td>
                        <td><input type="checkbox" name="verificacion_funcional[]" value="SO"></td>
                        <td><input type="checkbox" name="verificacion_funcional[]" value="Particiones"></td>
                        <td><input type="checkbox" name="verificacion_funcional[]" value="Software"></td>
                        <td><input type="checkbox" name="verificacion_funcional[]" value="Monitor"></td>
                        <td><input type="checkbox" name="verificacion_funcional[]" value="Red"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Adjuntar imágenes al final -->
    <div class="card shadow mb-3" style="max-width: 400px;">
        <div class="card-header bg-light">
            <strong>Adjuntar Imágenes</strong>
        </div>
        <div class="card-body">
            <input type="file" name="imagenes[]" multiple accept="image/*" class="form-control">
            <small class="text-muted">Puedes seleccionar varias imágenes</small>
        </div>
    </div>

    <!-- Botones fuera del card -->
    <div class="d-flex justify-content-between mt-3">
        <a href="{{ route('entregas.create') }}" class="btn btn-secondary btn-lg shadow">
            <i class="fas fa-arrow-left"></i> Atrás
        </a>

        <button type="submit" class="btn btn-success btn-lg shadow">
            <i class="fas fa-check"></i> Finalizar
        </button>
    </div>

</form>
@stop
