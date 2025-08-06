@extends('adminlte::page')
@section('title','CPU')
@section('content_header') <h1>CPU (Disponibles y Asignados)</h1> @stop
@section('content')
<table class="table table-striped">
  <thead>
    <tr>
      <th>Sel</th><th>Código</th><th>Marca</th><th>Modelo</th><th>Serie</th><th>Características</th><th>Estado</th>
    </tr>
  </thead>
  <tbody>
    @foreach($equipos as $e)
    <tr>
      <td>
        @if($e->estado === 'Disponible')
          <input type="checkbox" form="form-entrega" name="equipos[]" value="{{ $e->id }}">
        @endif
      </td>
      <td>{{ $e->codigo }}</td>
      <td>{{ $e->marca }}</td>
      <td>{{ $e->modelo }}</td>
      <td>{{ $e->serie }}</td>
      <td>{{ $e->caracteristicas }}</td>
      <td>
        <span class="badge {{ $e->estado === 'Disponible' ? 'bg-success' : 'bg-secondary' }}">
            {{ $e->estado }}
        </span>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{-- Form fijo para enviar selección (puedes colocarlo en layout si quieres que funcione desde cualquier pestaña) --}}
<form id="form-entrega" action="{{ route('entregas.store') }}" method="POST" class="mt-3">
  @csrf
  <div class="row">
    <div class="col-md-4">
      <label>Entregar a (usuario)</label>
      <select name="user_id" class="form-control" required>
        @foreach(\App\Models\User::orderBy('name')->get() as $u)
          <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-3">
      <label>Fecha de entrega</label>
      <input type="date" name="fecha_entrega" class="form-control" required>
    </div>
    <div class="col-md-5">
      <label>Observaciones</label>
      <input type="text" name="observaciones" class="form-control" placeholder="Opcional">
    </div>
  </div>
  <button class="btn btn-primary mt-3">Guardar y generar PDF</button>
</form>
@endsection
