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
            <h3 class="card-title">
                <i class="fas fa-laptop"></i>
                Lista de Equipos
            </h3>
            <div class="card-tools">
                <a href="{{ route('equipos.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Agregar Equipo
                </a>
            </div>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fas fa-check"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fas fa-ban"></i> {{ session('error') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover" id="equiposTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Tipo</th>
                            <th>Código</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Serie</th>
                            <th>Estado</th>
                            <th>Características</th>
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
                                                    ($equipo->tipo === 'Mouse' ? 'fa-mouse' : 
                                                    ($equipo->tipo === 'Impresora' ? 'fa-print' : 
                                                    ($equipo->tipo === 'Laptop' ? 'fa-laptop' : 
                                                    ($equipo->tipo === 'Tablet' ? 'fa-tablet-alt' : 
                                                    ($equipo->tipo === 'Telefono' ? 'fa-phone' : 
                                                    ($equipo->tipo === 'Proyector' ? 'fa-video' : 'fa-cogs')))))))) }}"></i>
                                    {{ $equipo->tipo_formatted }}
                                </td>
                                <td>
                                    <strong>{{ $equipo->codigo }}</strong>
                                </td>
                                <td>{{ $equipo->marca }}</td>
                                <td>{{ $equipo->modelo }}</td>
                                <td>
                                    <code>{{ $equipo->serie }}</code>
                                </td>
                                <td>
                                    <span class="badge {{ $equipo->estado_badge_class }}">
                                        {{ $equipo->estado }}
                                    </span>
                                </td>
                                <td>
                                    @if($equipo->caracteristicas && $equipo->caracteristicas != 'NULL')
                                        <span data-toggle="tooltip" title="{{ $equipo->caracteristicas }}">
                                            {{ Str::limit($equipo->caracteristicas, 30) }}
                                        </span>
                                    @else
                                        <span class="text-muted">Sin especificar</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('equipos.show', $equipo) }}" 
                                           class="btn btn-info btn-sm" 
                                           data-toggle="tooltip" 
                                           title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        <a href="{{ route('equipos.edit', $equipo) }}" 
                                           class="btn btn-warning btn-sm" 
                                           data-toggle="tooltip" 
                                           title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <button type="button" 
                                                class="btn btn-danger btn-sm" 
                                                data-toggle="modal" 
                                                data-target="#deleteModal{{ $equipo->id }}"
                                                data-tooltip="tooltip"
                                                title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <!-- Modal de confirmación para eliminar -->
                                    <div class="modal fade" id="deleteModal{{ $equipo->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">
                                                        <i class="fas fa-exclamation-triangle text-danger"></i>
                                                        Confirmar Eliminación
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>¿Estás seguro de que deseas eliminar el equipo:</p>
                                                    <div class="alert alert-info">
                                                        <strong>{{ $equipo->tipo }}</strong><br>
                                                        <strong>Código:</strong> {{ $equipo->codigo }}<br>
                                                        <strong>Marca:</strong> {{ $equipo->marca }}<br>
                                                        <strong>Modelo:</strong> {{ $equipo->modelo }}
                                                    </div>
                                                    <p class="text-danger">
                                                        <i class="fas fa-warning"></i>
                                                        Esta acción no se puede deshacer.
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                        <i class="fas fa-times"></i> Cancelar
                                                    </button>
                                                    <form action="{{ route('equipos.destroy', $equipo) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fas fa-trash"></i> Eliminar
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    <div class="p-4">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">No hay equipos registrados</h5>
                                        <p class="text-muted">Comienza agregando tu primer equipo al inventario.</p>
                                        <a href="{{ route('equipos.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Agregar Equipo
                                        </a>
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
                <i class="fas fa-info-circle"></i>
                Total de equipos: {{ $equipos->count() }}
            </small>
        </div>
    </div>
@stop

@section('css')
    <style>
        .table th {
            background-color: #343a40;
            color: white;
            font-weight: 600;
            border: none;
        }
        
        .badge {
            font-size: 0.75em;
        }
        
        .btn-group .btn {
            margin-right: 2px;
        }
        
        .btn-group .btn:last-child {
            margin-right: 0;
        }
        
        .table-responsive {
            border-radius: 0.375rem;
        }
        
        code {
            background-color: #f8f9fa;
            color: #e83e8c;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.875em;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Inicializar DataTable
            $('#equiposTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                },
                "responsive": true,
                "pageLength": 10,
                "order": [[ 1, "asc" ]], // Ordenar por código
                "columnDefs": [
                    { "orderable": false, "targets": 7 } // No ordenar columna de acciones
                ]
            });
            
            // Inicializar tooltips
            $('[data-toggle="tooltip"]').tooltip();
            
            // Auto-ocultar alertas después de 5 segundos
            setTimeout(function() {
                $('.alert-dismissible').fadeOut('slow');
            }, 5000);
        });
    </script>
@stop