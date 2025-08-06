@extends('adminlte::page')
@section('title','Crear Entrega')
@section('content_header') <h1>Crear Entrega</h1> @stop
@section('content')
<form action="{{ route('entregas.store') }}" method="POST">
@csrf
<div class="row mb-3">
  <div class="col-md-4">
    <label>Usuario</label>
    <select name="user_id" class="form-control" required>
      @foreach($usuarios as $u)
        <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-3">
    <label>Fecha</label>
    <input type="date" name="fecha_entrega" class="form-control" required>
  </div>
  <div class="col-md-5">
    <label>Observaciones</label>
    <input type="text" name="observaciones" class="form-control">
  </div>
</div>

<h4>CPU</h4>
@include('entregas.partes.lista', ['items' => $cpus])

<h4>Monitores</h4>
@include('entregas.partes.lista', ['items' => $monitores])

<h4>Teclados</h4>
@include('entregas.partes.lista', ['items' => $teclados])

<h4>Mouse</h4>
@include('entregas.partes.lista', ['items' => $mouses])

<button class="btn btn-primary mt-3">Guardar y generar PDF</button>
</form>
@endsection
