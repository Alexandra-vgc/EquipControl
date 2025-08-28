@extends('adminlte::page')

@section('title', 'Mi Perfil')

@section('content_header')
    <h1 class="text-center">Mi Perfil</h1>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- 🔹 Envolvemos el row con un contenedor flex que centra -->
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="row w-100 d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">

                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                             src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('storage/usuarios/usuario.png') }}"
                             alt="Foto de perfil" width="150">
                    </div>

                    <h3 class="profile-username text-center">{{ $user->name }}</h3>
                    <p class="text-muted text-center">{{ $user->email }}</p>

                    <!-- Datos extras debajo -->
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b><i class="fas fa-id-card"></i> Cédula</b>
                            <span class="float-right">{{ $user->document ?? 'No registrado' }}</span>
                        </li>
                        <li class="list-group-item">
                            <b><i class="fas fa-phone"></i> Teléfono</b>
                            <span class="float-right">{{ $user->phone ?? 'No registrado' }}</span>
                        </li>
                        <li class="list-group-item">
                            <b><i class="fas fa-envelope"></i> Correo</b>
                            <span class="float-right">{{ $user->email }}</span>
                        </li>
                    </ul>

                    <!-- Botón para abrir el modal -->
                    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#editarPerfilModal">
                        <i class="fas fa-edit"></i> Editar Perfil
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar perfil -->
<div class="modal fade" id="editarPerfilModal" tabindex="-1" role="dialog" aria-labelledby="editarPerfilModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ route('usuario.actualizarPerfil') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="editarPerfilModalLabel">
            <i class="fas fa-user-edit"></i> Editar Perfil
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
              <label><i class="fas fa-user"></i> Nombre completo</label>
              <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
          </div>

          <div class="form-group">
              <label><i class="fas fa-id-card"></i> Cédula</label>
              <input type="text" name="document" value="{{ old('document', $user->document) }}" class="form-control">
          </div>

          <div class="form-group">
              <label><i class="fas fa-phone"></i> Teléfono</label>
              <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control">
          </div>

          <div class="form-group">
              <label><i class="fas fa-envelope"></i> Correo electrónico</label>
              <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
          </div>

          <div class="form-group">
              <label><i class="fas fa-camera"></i> Foto de perfil</label>
              <input type="file" name="avatar" class="form-control">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times"></i> Cerrar
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Guardar cambios
          </button>
        </div>

      </form>
    </div>
  </div>
</div>

@stop
