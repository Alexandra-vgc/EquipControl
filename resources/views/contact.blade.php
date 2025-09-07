@extends('adminlte::page')

@section('title', 'Contacto')

@section('content_header')
    <h1 class="text-bold text-dark">Contacto</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}">
                    @error('nombre') 
                        <small class="text-danger">{{ $message }}</small> 
                    @enderror
                </div>

                <div class="form-group">
                    <label for="correo">Correo Electrónico</label>
                    <input type="email" name="correo" id="correo" class="form-control" value="{{ old('correo') }}">
                    @error('correo') 
                        <small class="text-danger">{{ $message }}</small> 
                    @enderror
                </div>

                <div class="form-group">
                    <label for="mensaje">Mensaje</label>
                    <textarea name="mensaje" id="mensaje" class="form-control" rows="4">{{ old('mensaje') }}</textarea>
                    @error('mensaje') 
                        <small class="text-danger">{{ $message }}</small> 
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Enviar Mensaje
                </button>
            </form>
        </div>
    </div>
@stop
