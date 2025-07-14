@extends('adminlte::page')

@section('title', 'Perfil de Usuario')

@section('content_header')
    <h1>Perfil de Usuario</h1>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success" id="success-msg">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        {{-- Muestra el nombre real o el falso si no existe --}}
        <h3 class="card-title">{{ $usuario['name'] ?? 'Admin' }}</h3>
        <button id="btn-editar" class="btn btn-outline-primary btn-sm">Editar perfil</button>
    </div>

    <form action="{{ route('usuario.perfil.guardar') }}" method="POST" enctype="multipart/form-data" id="perfil-form" class="card-body">
        @csrf

        <div class="row">
            <div class="col-md-3 text-center">
                <div class="position-relative d-inline-block">
                    <img src="{{ asset('vendor/adminlte/dist/img/usuario.png') }}" alt="Foto perfil" id="foto-perfil" class="img-thumbnail rounded-circle" style="width:150px; height:150px; object-fit:cover;">
                    <label for="input-foto" class="btn btn-primary btn-sm position-absolute" style="bottom:10px; right:10px; cursor:pointer;">
                        <i class="fas fa-pencil-alt"></i>
                    </label>
                    <input type="file" id="input-foto" name="imagen" accept="image/*" style="display:none" disabled>
                </div>
            </div>

            <div class="col-md-9">
                <div class="form-group">
                    <label>Nombre completo</label>
                    <input type="text" name="name" class="form-control" value="{{ $usuario['name'] ?? 'Admin Admin' }}" disabled>
                </div>
                <div class="form-group">
                    <label>Correo electrónico</label>
                    <input type="email" name="email" class="form-control" value="{{ $usuario['email'] ?? 'admin@gmail.com' }}" disabled>
                </div>
                <div class="form-group">
                    <label>Ciudad</label>
                    <input type="text" name="ciudad" class="form-control" value="{{ $usuario['ciudad'] ?? 'Quito' }}" disabled>
                </div>
                <div class="form-group">
                    <label>País</label>
                    <input type="text" name="pais" class="form-control" value="{{ $usuario['pais'] ?? 'Ecuador' }}" disabled>
                </div>
                <!-- Puedes agregar más campos igual -->
            </div>
        </div>

        <div class="mt-3 text-right">
            <button type="submit" class="btn btn-success" id="btn-guardar" style="display:none;">Guardar cambios</button>
        </div>
    </form>
</div>

<script>
    const btnEditar = document.getElementById('btn-editar');
    const btnGuardar = document.getElementById('btn-guardar');
    const form = document.getElementById('perfil-form');
    const inputs = form.querySelectorAll('input');
    const inputFoto = document.getElementById('input-foto');
    const fotoPerfil = document.getElementById('foto-perfil');

    btnEditar.addEventListener('click', function() {
        const disabled = inputs[0].disabled; // chequea el primer input

        if (disabled) {
            // Activar edición
            inputs.forEach(i => i.disabled = false);
            inputFoto.disabled = false;
            btnGuardar.style.display = 'inline-block';
            btnEditar.textContent = 'Cancelar edición';
        } else {
            // Desactivar edición sin guardar
            inputs.forEach(i => i.disabled = true);
            inputFoto.disabled = true;
            btnGuardar.style.display = 'none';
            btnEditar.textContent = 'Editar perfil';
            // Resetear valores a originales si quieres
            form.reset();
            // Reset foto a original si cambió
            fotoPerfil.src = '{{ asset("vendor/adminlte/dist/img/usuario.png") }}';
        }
    });

    // Mostrar preview imagen seleccionada
    inputFoto.addEventListener('change', function(e){
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(evt) {
                fotoPerfil.src = evt.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Ocultar mensaje de éxito después de 3 seg
    const successMsg = document.getElementById('success-msg');
    if(successMsg){
        setTimeout(() => { successMsg.style.display = 'none'; }, 3000);
    }
</script>

@stop
