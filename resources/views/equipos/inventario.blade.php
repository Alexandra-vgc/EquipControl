@extends('adminlte::page')

@section('title', 'EquipControl - Inventario de Equipos')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>Inventario de Equipos</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Equipos</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-laptop"></i> Lista de Equipos</h3>
            <div class="card-tools">
                {{-- Solo admin puede agregar equipos --}}
                @can('admin')
                    <a href="{{ route('equipos.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Agregar Equipo
                    </a>
                @endcan
            </div>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="icon fas fa-check"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="icon fas fa-ban"></i> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover" id="equiposTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Tipo</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Serial</th>
                            <th>Detalles</th>
                            <th>Estado</th>
                            <th width="150">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($equipos as $equipo)
                        <tr>
                            <td>
                                <i class="fas {{ $equipo->tipo === 'CPU' ? 'fa-desktop' : 
                                                ($equipo->tipo === 'Monitor' ? 'fa-tv' : 
                                                ($equipo->tipo === 'Teclado' ? 'fa-keyboard' : 
                                                ($equipo->tipo === 'Mouse' ? 'fa-mouse' : 'fa-cogs'))) }}"></i>
                                {{ $equipo->tipo }}
                            </td>
                            <td>{{ $equipo->marca ?? '-' }}</td>
                            <td>{{ $equipo->modelo ?? '-' }}</td>
                            <td><code>{{ $equipo->serial ?? '-' }}</code></td>
                            <td>
                                @if($equipo->tipo === 'CPU')
                                    Mainboard: {{ $equipo->mainboard_marca }} {{ $equipo->mainboard_modelo }}<br>
                                    Procesador: {{ $equipo->procesador }}<br>
                                    RAM: {{ $equipo->memoria_ram }} GB<br>
                                    Disco: {{ $equipo->capacidad_disco }}
                                @elseif($equipo->tipo === 'Monitor')
                                    Energía: {{ $equipo->energia }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $equipo->estado_badge_class ?? 'badge-secondary' }}">
                                    {{ $equipo->estado }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    {{-- TODOS pueden ver detalles --}}
                                    <a href="{{ route('equipos.show', $equipo) }}" class="btn btn-info btn-sm" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    {{-- Solo ADMIN puede editar --}}
                                    @can('admin')
                                        <a href="{{ route('equipos.edit', $equipo) }}" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan
                                    
                                    {{-- Solo ADMIN puede eliminar --}}
                                    @can('admin')
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $equipo->id }}" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endcan
                                </div>

                                {{-- Modal eliminar - solo para ADMIN --}}
                                @can('admin')
                                    <div class="modal fade" id="deleteModal{{ $equipo->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><i class="fas fa-exclamation-triangle text-danger"></i> Confirmar Eliminación</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>¿Eliminar este equipo?</p>
                                                    <div class="alert alert-info">
                                                        <strong>{{ $equipo->tipo }}</strong><br>
                                                        <strong>Marca:</strong> {{ $equipo->marca }}<br>
                                                        <strong>Modelo:</strong> {{ $equipo->modelo }}<br>
                                                        <strong>Serial:</strong> {{ $equipo->serial }}
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <form action="{{ route('equipos.destroy', $equipo) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endcan

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                <div class="p-4 text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <h5>No hay equipos registrados</h5>
                                    {{-- Solo admin puede agregar equipos desde aquí también --}}
                                    @can('admin')
                                        <a href="{{ route('equipos.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Agregar Equipo</a>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            <small class="text-muted">
                <i class="fas fa-info-circle"></i> Total de equipos: {{ $equipos->count() }}
            </small>
        </div>
    </div>
@stop

@section('css')
<style>
    .table th { background-color: #343a40; color: white; font-weight: 600; border: none; }
    .badge { font-size: 0.75em; }
    .btn-group .btn { margin-right: 2px; }
    .table-responsive { border-radius: 0.375rem; }
    code { background-color: #f8f9fa; color: #e83e8c; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.875em; }
</style>
@stop

@section('js')
<script>
$(document).ready(function() {
    $('#equiposTable').DataTable({
        "language": { "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json" },
        "responsive": true,
        "pageLength": 10,
        "order": [[ 0, "asc" ]],
        "columnDefs": [{ "orderable": false, "targets": 6 }]
    });
    $('[data-toggle="tooltip"]').tooltip();
    setTimeout(function() { $('.alert-dismissible').fadeOut('slow'); }, 5000);
});
</script>
@stop