@extends('adminlte::page')

@section('title', 'EquipControl - Crear Entrega')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>
                <i class="fas fa-file-alt"></i> {{-- Ícono de entrega --}}
                Crear Entrega
            </h1>
            <p class="text-muted mb-0">
                Registra la entrega de equipos de manera rápida y segura
            </p>
        </div>
        <div class="col-sm-6">
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

    <!-- Datos generales de la entrega -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-user"></i> Datos de la Entrega
            </h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label><strong>Usuario</strong></label>
                    <select name="user_id" class="form-control select2" required>
                        @foreach($usuarios as $u)
                            <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label><strong>Fecha</strong></label>
                    <input type="date" name="fecha_entrega" class="form-control" required>
                </div>
                <div class="col-md-5">
                    <label><strong>Observaciones</strong></label>
                    <input type="text" name="observaciones" class="form-control">
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

    <!-- Listado de equipos por categoría -->
    @foreach($categorias as $nombre => $items)
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white"> {{-- CAMBIO: azul en lugar de bg-dark --}}
            <h4 class="card-title mb-0">
                <i class="fas 
                    {{ $nombre === 'CPU' ? 'fa-desktop' : 
                       ($nombre === 'Monitores' ? 'fa-tv' : 
                       ($nombre === 'Teclados' ? 'fa-keyboard' : 
                       ($nombre === 'Mouse' ? 'fa-mouse' : 'fa-box'))) }} ">
                </i>
                {{ $nombre }}
            </h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="thead-light"> {{-- más claro para resaltar con azul --}}
                        <tr>
                            <th style="width: 50px;">Sel</th>
                            <th>Código</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Serie</th>
                            <th>Características</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $i)
                        <tr>
                            <td>
                                <input type="checkbox" name="{{ strtolower($nombre) }}[]" value="{{ $i->id }}">
                            </td>
                            <td><strong>{{ $i->codigo }}</strong></td>
                            <td>{{ $i->marca }}</td>
                            <td>{{ $i->modelo }}</td>
                            <td><code>{{ $i->serie }}</code></td>
                            <td>
                                @if($i->caracteristicas && $i->caracteristicas != 'NULL')
                                    <span data-toggle="tooltip" title="{{ $i->caracteristicas }}">
                                        {{ Str::limit($i->caracteristicas, 30) }}
                                    </span>
                                @else
                                    <span class="text-muted">Sin especificar</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
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

    <button class="btn btn-success btn-lg"> {{-- CAMBIO: verde --}}
        <i class="fas fa-save"></i> Guardar y generar PDF
    </button>
</form>
@stop

@section('css')
    <style>
        /* Igualamos estilo al Inventario */
        .card-header {
            border-bottom: 1px solid #dee2e6;
        }

        .table th {
            font-weight: 600;
        }

        code {
            background-color: #f8f9fa;
            color: #e83e8c;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.875em;
        }

        input[type="checkbox"] {
            width: 1.2rem;
            height: 1.2rem;
        }

        /* Disminuir resolución */
        body {
            font-size: 0.9rem;
        }
        .card {
            max-width: 95%;
            margin: auto;
        }
        h1 {
            font-size: 1.6rem;
        }
    </style>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        $('.select2').select2({ width: '100%' });
    });
</script>
@stop
