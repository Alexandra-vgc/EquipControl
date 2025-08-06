@extends('adminlte::page')

@section('title', 'Nuevo Equipo')
@section('content_header')
  <h1>Registrar nuevo equipo</h1>
@stop

@section('content')
@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
    </ul>
  </div>
@endif

<form action="{{ route('equipos.store') }}" method="POST">
  @csrf

  <div class="row">
    <div class="col-md-3">
      <label>Tipo *</label>
      <select name="tipo" class="form-control" required>
        @foreach(['CPU','Monitor','Teclado','Mouse'] as $t)
          <option value="{{ $t }}" {{ old('tipo')===$t ? 'selected':'' }}>{{ $t }}</option>
        @endforeach
      </select>
    </div>

    <div class="col-md-3">
      <label>Marca</label>
      <input type="text" name="marca" class="form-control" value="{{ old('marca') }}">
    </div>

    <div class="col-md-3">
      <label>Modelo</label>
      <input type="text" name="modelo" class="form-control" value="{{ old('modelo') }}">
    </div>

    <div class="col-md-3">
      <label>Estado *</label>
      <select name="estado" class="form-control" required>
        @foreach(['Disponible','Asignado','En Reparación','Dañado'] as $e)
          <option value="{{ $e }}" {{ old('estado')===$e ? 'selected':'' }}>{{ $e }}</option>
        @endforeach
      </select>
    </div>

    <div class="col-md-3 mt-3">
      <label>Código (Inventario)</label>
      <input type="text" name="codigo" class="form-control" value="{{ old('codigo') }}">
    </div>

    <div class="col-md-3 mt-3">
      <label>Serie</label>
      <input type="text" name="serie" class="form-control" value="{{ old('serie') }}">
    </div>

    <div class="col-md-6 mt-3">
      <label>Características</label>
      <input type="text" name="caracteristicas" class="form-control" placeholder="Ej: i5 10th, 8GB RAM, 256GB SSD" value="{{ old('caracteristicas') }}">
    </div>
  </div>

  <button class="btn btn-primary mt-3">Guardar equipo</button>
  <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Cancelar</a>
</form>
@endsection
