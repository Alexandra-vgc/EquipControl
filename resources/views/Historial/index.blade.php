{{-- Si usas AdminLTE: deja adminlte::page; si usas layouts.app cambia la primera línea --}}
@extends('adminlte::page')

@section('title', 'Historial')

@section('content_header')
    <h1>Historial</h1>
@stop

@section('content')
<div class="container-fluid">
    <form method="GET" class="row g-2 mb-3">
        <div class="col-auto">
            <input type="text" name="equipo_id" class="form-control" placeholder="Equipo ID" value="{{ request('equipo_id') }}">
        </div>
        <div class="col-auto">
            <input type="text" name="usuario_id" class="form-control" placeholder="Usuario ID" value="{{ request('usuario_id') }}">
        </div>
        <div class="col-auto">
            <select name="accion" class="form-select">
                <option value="">-- Acción --</option>
                <option value="entrega" {{ request('accion')=='entrega' ? 'selected' : '' }}>Entrega</option>
                <option value="devolucion" {{ request('accion')=='devolucion' ? 'selected' : '' }}>Devolución</option>
                <option value="crear" {{ request('accion')=='crear' ? 'selected' : '' }}>Crear</option>
                <option value="editar" {{ request('accion')=='editar' ? 'selected' : '' }}>Editar</option>
                <option value="eliminar" {{ request('accion')=='eliminar' ? 'selected' : '' }}>Eliminar</option>
            </select>
        </div>
        <div class="col-auto">
            <button class="btn btn-primary">Filtrar</button>
        </div>
    </form>

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-sm mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Equipo</th>
                        <th>Usuario</th>
                        <th>Acción</th>
                        <th>Observaciones</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($historiales as $historial)
                        <tr>
                            <td>{{ $historial->id }}</td>
                            <td>{{ $historial->equipo->codigo ?? $historial->equipo->nombre ?? ('#'.$historial->equipo_id) }}</td>
                            <td>{{ $historial->usuario->name ?? ('#'.$historial->usuario_id) }}</td>
                            <td>{{ ucfirst($historial->accion) }}</td>
                            <td style="max-width:300px;word-wrap:break-word;">{{ $historial->observaciones ?? '—' }}</td>
                            <td>{{ $historial->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No hay registros.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {{ $historiales->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@stop
