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
    <!-- Tipo de equipo -->
    <div class="col-md-3">
      <label>Tipo *</label>
      <select name="tipo" id="tipo" class="form-control" required>
        @foreach(['CPU','Monitor','Teclado','Mouse'] as $t)
          <option value="{{ $t }}" {{ old('tipo')===$t ? 'selected':'' }}>{{ $t }}</option>
        @endforeach
      </select>
    </div>

    <!-- Estado -->
    <div class="col-md-3">
      <label>Estado *</label>
      <select name="estado" class="form-control" required>
        @foreach(['Disponible','Asignado','En Reparación','Dañado'] as $e)
          <option value="{{ $e }}" {{ old('estado')===$e ? 'selected':'' }}>{{ $e }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <!-- Campos dinámicos -->
  <div class="row mt-3">
    <!-- CPU -->
    <div class="cpu-fields d-none col-md-3">
        <label>Tipo CPU</label>
        <select name="tipo_cpu" class="form-control">
            @foreach(['Desktop','Laptop'] as $t)
                <option value="{{ $t }}" {{ old('tipo_cpu')===$t ? 'selected':'' }}>{{ $t }}</option>
            @endforeach
        </select>
    </div>
    <div class="cpu-fields d-none col-md-3">
        <label>Marca</label>
        <input type="text" name="marca" class="form-control" value="{{ old('marca') }}">
    </div>
    <div class="cpu-fields d-none col-md-3">
        <label>Modelo</label>
        <input type="text" name="modelo" class="form-control" value="{{ old('modelo') }}">
    </div>
    <div class="cpu-fields d-none col-md-3">
        <label>Serial</label>
        <input type="text" name="serial" class="form-control" value="{{ old('serial') }}">
    </div>
    <div class="cpu-fields d-none col-md-3 mt-3">
        <label>Mainboard Marca</label>
        <input type="text" name="mainboard_marca" class="form-control" value="{{ old('mainboard_marca') }}">
    </div>
    <div class="cpu-fields d-none col-md-3 mt-3">
        <label>Mainboard Modelo</label>
        <input type="text" name="mainboard_modelo" class="form-control" value="{{ old('mainboard_modelo') }}">
    </div>
    <div class="cpu-fields d-none col-md-3 mt-3">
        <label>Procesador</label>
        <input type="text" name="procesador" class="form-control" value="{{ old('procesador') }}">
    </div>
    <div class="cpu-fields d-none col-md-3 mt-3">
        <label>Memoria RAM (GB)</label>
        <input type="number" name="memoria_ram" class="form-control" value="{{ old('memoria_ram') }}">
    </div>
    <div class="cpu-fields d-none col-md-3 mt-3">
        <label>Capacidad de Disco</label>
        <input type="text" name="capacidad_disco" class="form-control" value="{{ old('capacidad_disco') }}">
    </div>

    <!-- Monitor -->
    <div class="monitor-fields d-none col-md-3">
        <label>Marca</label>
        <input type="text" name="marca_monitor" class="form-control" value="{{ old('marca') }}">
    </div>
    <div class="monitor-fields d-none col-md-3">
        <label>Modelo</label>
        <input type="text" name="modelo_monitor" class="form-control" value="{{ old('modelo') }}">
    </div>
    <div class="monitor-fields d-none col-md-3">
        <label>Serial</label>
        <input type="text" name="serial_monitor" class="form-control" value="{{ old('serial') }}">
    </div>
    <div class="monitor-fields d-none col-md-3">
        <label>Energía (Cargador/Cable)</label>
        <input type="text" name="energia" class="form-control" value="{{ old('energia') }}">
    </div>

    <!-- Teclado y Mouse -->
    <div class="input-serial d-none col-md-3">
        <label>Serial</label>
        <input type="text" name="serial_simple" class="form-control" value="{{ old('serial') }}">
    </div>
  </div>

  <button class="btn btn-primary mt-3">Guardar equipo</button>
  <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Cancelar</a>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tipo = document.getElementById('tipo');
    function toggleFields() {
        const t = tipo.value;
        document.querySelectorAll('.cpu-fields').forEach(e => e.classList.add('d-none'));
        document.querySelectorAll('.monitor-fields').forEach(e => e.classList.add('d-none'));
        document.querySelectorAll('.input-serial').forEach(e => e.classList.add('d-none'));

        if(t==='CPU') document.querySelectorAll('.cpu-fields').forEach(e => e.classList.remove('d-none'));
        if(t==='Monitor') document.querySelectorAll('.monitor-fields').forEach(e => e.classList.remove('d-none'));
        if(t==='Teclado' || t==='Mouse') document.querySelectorAll('.input-serial').forEach(e => e.classList.remove('d-none'));
    }
    tipo.addEventListener('change', toggleFields);
    toggleFields();
});
</script>
@endsection
