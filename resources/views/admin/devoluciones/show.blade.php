@extends('adminlte::page')

@section('title','Detalle Devolución')

@section('content_header')
  <h1>Detalle Devolución #{{ $devol->id }}</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <a href="{{ route('admin.devoluciones.create') }}" class="btn btn-sm btn-secondary mb-3">Registrar otra</a>

    <table class="table table-bordered">
      <tr>
        <th>ID</th><td>{{ $devol->id }}</td>
        <th>Fecha</th><td>{{ optional($devol->fecha_devolucion)->format('Y-m-d') ?? $devol->created_at->format('Y-m-d') }}</td>
      </tr>
      <tr>
        <th>Equipo</th>
        <td colspan="3">
          {{ $devol->equipo->tipo ?? '' }} {{ $devol->equipo->marca ?? '' }} {{ $devol->equipo->modelo ?? '' }}
          {{ $devol->equipo->serie ?? $devol->equipo->codigo ?? '' }}
        </td>
      </tr>
      <tr>
        <th>Usuario (quien tenía)</th>
        <td colspan="3">{{ $devol->user->name ?? '-' }} ({{ $devol->user->email ?? '-' }})</td>
      </tr>
      <tr>
        <th>Quien entrega</th>
        <td>{{ $devol->entrega_nombre ?? '-' }} ({{ $devol->entrega_cc ?? '-' }})</td>
        <th>Quien recibe</th>
        <td>{{ $devol->recibe_nombre ?? '-' }} ({{ $devol->recibe_cc ?? '-' }})</td>
      </tr>
      <tr>
        <th>Observaciones</th>
        <td colspan="3">{{ $devol->observaciones ?? '-' }}</td>
      </tr>
    </table>

    <h5>Verificación</h5>
    @php
      $ver = is_string($devol->verificacion) ? json_decode($devol->verificacion, true) : ($devol->verificacion ?? []);
      $acc = is_string($devol->accesorios) ? json_decode($devol->accesorios, true) : ($devol->accesorios ?? []);
    @endphp

    <div class="row mb-3">
      <div class="col-md-6">
        <ul class="list-group">
          <li class="list-group-item"><strong>Encendido:</strong> {{ ($ver['encendido'] ?? false) ? 'Sí' : 'No' }}</li>
          <li class="list-group-item"><strong>Pantalla:</strong> {{ ($ver['pantalla'] ?? false) ? 'Sí' : 'No' }}</li>
          <li class="list-group-item"><strong>Teclado/Mouse:</strong> {{ ($ver['teclado_mouse'] ?? false) ? 'Sí' : 'No' }}</li>
          <li class="list-group-item"><strong>S.O.:</strong> {{ ($ver['so'] ?? false) ? 'Sí' : 'No' }}</li>
        </ul>
      </div>
      <div class="col-md-6">
        <ul class="list-group">
          <li class="list-group-item"><strong>Cargador:</strong> {{ ($acc['cargador'] ?? false) ? 'Sí' : 'No' }}</li>
          <li class="list-group-item"><strong>Mouse:</strong> {{ ($acc['mouse'] ?? false) ? 'Sí' : 'No' }}</li>
          <li class="list-group-item"><strong>Maleta:</strong> {{ ($acc['maleta'] ?? false) ? 'Sí' : 'No' }}</li>
        </ul>
      </div>
    </div>

    <div class="mt-3">
      @if(!empty($devol->pdf_path))
        <a href="{{ asset($devol->pdf_path) }}" target="_blank" class="btn btn-primary">Descargar Acta (PDF)</a>
      @endif

      @if(!empty($devol->evidencia_path))
        <a href="{{ asset($devol->evidencia_path) }}" target="_blank" class="btn btn-info">Ver Escaneo / Evidencia</a>
      @endif

      <a href="{{ route('admin.devoluciones.create') }}" class="btn btn-success">Nuevo</a>
    </div>
  </div>
</div>
@stop
