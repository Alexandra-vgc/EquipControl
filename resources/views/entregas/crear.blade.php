@extends('adminlte::page')

@section('title', 'EquipControl - Crear Entrega')

@section('content_header')
    <div class="row align-items-center">
        <div class="col-sm-8">
            <h1 class="mb-1">
                <i class="fas fa-file-alt text-primary"></i>
                Crear Entrega
            </h1>
            <p class="text-muted mb-0">
                Registra la entrega de equipos de manera rápida y segura
            </p>
        </div>
        <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Entregas</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
<form action="{{ route('entregas.store') }}" method="POST">
    @csrf

    <!-- Datos generales -->
    <div class="card shadow">
        <div class="card-header bg-light">
            <h3 class="card-title text-primary mb-0">
                <i class="fas fa-user"></i> Datos del colaborador que recibe el equipo
            </h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label><strong>Nombre</strong></label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label><strong>Correo</strong></label>
                    <input type="email" name="correo" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label><strong>Cargo</strong></label>
                    <input type="text" name="cargo" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label><strong>Área</strong></label>
                    <input type="text" name="area" class="form-control">
                </div>
                <div class="col-md-4">
                    <label><strong>Sede</strong></label>
                    <input type="text" name="sede" class="form-control">
                </div>
            </div>
        </div>
    </div>

    @php
        $categorias = [
            'CPU' => $cpus,
            'Monitores' => $monitores,
            'Teclados' => $teclados,
            'Mouse' => $mouses
        ];
    @endphp

    <!-- Equipos disponibles -->
    @foreach($categorias as $nombre => $items)
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title mb-0">
                <i class="fas 
                    {{ $nombre === 'CPU' ? 'fa-desktop' : 
                       ($nombre === 'Monitores' ? 'fa-tv' : 
                       ($nombre === 'Teclados' ? 'fa-keyboard' : 
                       ($nombre === 'Mouse' ? 'fa-mouse' : 'fa-box'))) }}">
                </i>
                {{ $nombre }}
            </h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Sel</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Serial</th>
                            @if($nombre === 'CPU')
                                <th>Mainboard Marca</th>
                                <th>Mainboard Modelo</th>
                                <th>Procesador</th>
                                <th>RAM</th>
                                <th>Disco</th>
                            @elseif($nombre === 'Monitores')
                                <th>Energía</th>
                            @endif
                            <th>Estado</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $i)
                        <tr>
                            <td><input type="checkbox" name="equipos[]" value="{{ $i->id }}"></td>
                            <td>{{ $i->marca }}</td>
                            <td>{{ $i->modelo }}</td>
                            <td><code>{{ $i->serial }}</code></td>

                            @if($nombre === 'CPU')
                                <td>{{ $i->mainboard_marca }}</td>
                                <td>{{ $i->mainboard_modelo }}</td>
                                <td>{{ $i->procesador }}</td>
                                <td>{{ $i->memoria_ram }} GB</td>
                                <td>{{ $i->capacidad_disco }}</td>
                            @elseif($nombre === 'Monitores')
                                <td>{{ $i->energia ?? '—' }}</td>
                            @endif

                            <td>
                                <span class="badge {{ $i->estado_badge_class }}">
                                   {{ $i->estado_formatted }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">
                                <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                No hay disponibles.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    @endforeach

    <button class="btn btn-success btn-lg shadow">
        <i class="fas fa-save"></i> Guardar y Siguiente
    </button>
</form>
@stop

@section('css')
<style>
    code {
        background-color: #f8f9fa;
        color: #e83e8c;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.875em;
    }
    .table th { font-weight: 600; }
    input[type="checkbox"] {
        width: 1.2rem; height: 1.2rem;
    }
    body { font-size: 0.9rem; }
</style>
@stop

@section('js')
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
        $('.select2').select2({ width: '100%' });
    });
</script>
@stop
