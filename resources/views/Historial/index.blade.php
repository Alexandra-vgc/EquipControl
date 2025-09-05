@extends('adminlte::page')

@section('title', 'Historial')

@section('content_header')
<h1>Historial</h1>
@stop

@section('content')
<div class="container-fluid">

    {{-- Buscador y filtros --}}
    <form method="GET" class="row g-2 mb-3">
        <div class="col-auto">
            <input type="text" name="search" class="form-control" placeholder="Buscar..." value="{{ request('search') }}">
        </div>
        <div class="col-auto">
            <select name="rol" class="form-select">
                <option value="">-- Todos los roles --</option>
                <option value="admin" {{ request('rol')=='admin'?'selected':'' }}>Admin</option>
                <option value="editor" {{ request('rol')=='editor'?'selected':'' }}>Editor</option>
                <option value="usuario" {{ request('rol')=='usuario'?'selected':'' }}>Usuario</option>
            </select>
        </div>
        <div class="col-auto">
            <input type="date" name="fecha" class="form-control" value="{{ request('fecha') }}">
        </div>
        <div class="col-auto">
            <button class="btn btn-primary">Filtrar</button>
        </div>
    </form>

    {{-- Tabla de historial --}}
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
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($historiales as $historial)
                        <tr id="historial-{{ $historial->id }}">
                            <td>{{ $historial->id }}</td>
                            <td>{{ $historial->equipo?->codigo ?? $historial->equipo?->nombre ?? ('#'.$historial->equipo_id) }}</td>
                            <td>{{ $historial->usuario?->name ?? ('#'.$historial->usuario_id) }}</td>
                            <td>{{ ucfirst($historial->accion) }}</td>
                            <td style="max-width:300px;word-wrap:break-word;">{{ $historial->observaciones ?? '—' }}</td>
                            <td>{{ $historial->created_at?->format('d/m/Y H:i') ?? '—' }}</td>
                            <td>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $historial->id }}">X</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No hay registros.</td>
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

@section('js')
<script>
document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const id = this.dataset.id;
        if(confirm('¿Seguro que deseas eliminar este historial?')) {
            // Construimos la URL correcta con Laravel
            const url = "{{ url('historial') }}/" + id;

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    // Eliminamos la fila de la tabla
                    document.getElementById(`historial-${id}`).remove();
                } else {
                    alert('No se pudo eliminar el registro.');
                }
            })
            .catch(error => {
                console.error(error);
                alert('Error al conectar con el servidor.');
            });
        }
    });
});
</script>
@stop