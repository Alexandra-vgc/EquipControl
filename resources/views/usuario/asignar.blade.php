@extends('adminlte::page')

@section('title', 'Asignar Roles')

@section('content_header')
    <h1><i class="fas fa-user-shield"></i> Asignar Rol a Usuario</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">

            {{-- Mensajes de éxito o error --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-triangle"></i> Corrige los siguientes errores:
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Tarjeta con formulario --}}
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title"><i class="fas fa-user-cog"></i> Seleccionar Usuario y Rol</h3>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.usuario.asignar.store') }}" method="POST">
                        @csrf

                        {{-- Selección de usuario --}}
                        <div class="form-group mb-3">
                            <label for="user_id"><i class="fas fa-user"></i> Usuario</label>
                            <select name="user_id" id="user_id" class="form-control select2" required>
                                <option value="">-- Selecciona un usuario --</option>
                                @foreach($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}">
                                        {{ $usuario->name }} ({{ $usuario->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Selección de rol --}}
                        <div class="form-group mb-3">
                            <label for="role"><i class="fas fa-id-badge"></i> Rol</label>
                            <select name="role" id="role" class="form-control select2" required>
                                <option value="">-- Selecciona un rol --</option>
                                @foreach($roles as $rol)
                                    <option value="{{ $rol->name }}">{{ ucfirst($rol->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Botón --}}
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Asignar Rol
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Estilos adicionales (opcional) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css">
@stop

@section('js')
    {{-- Scripts para select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: "Selecciona una opción",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@stop
