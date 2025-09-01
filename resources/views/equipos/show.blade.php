@extends('adminlte::page')

@section('title', 'Detalle del Equipo')

@section('content_header')
    <h1 class="text-primary"><i class="fas fa-desktop"></i> Detalle del Equipo</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0"><i class="fas fa-info-circle"></i> Información del Equipo</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">ID</dt>
                        <dd class="col-sm-8">{{ $equipo->id }}</dd>

                        <dt class="col-sm-4">Tipo</dt>
                        <dd class="col-sm-8">{{ $equipo->tipo }}</dd>

                        <dt class="col-sm-4">Marca</dt>
                        <dd class="col-sm-8">{{ $equipo->marca }}</dd>

                        <dt class="col-sm-4">Modelo</dt>
                        <dd class="col-sm-8">{{ $equipo->modelo }}</dd>

                        <dt class="col-sm-4">Estado</dt>
                        <dd class="col-sm-8">
                            @if($equipo->estado == 'Disponible')
                                <span class="badge badge-success">{{ $equipo->estado }}</span>
                            @elseif($equipo->estado == 'Asignado')
                                <span class="badge badge-warning">{{ $equipo->estado }}</span>
                            @elseif($equipo->estado == 'En Reparación')
                                <span class="badge badge-info">{{ $equipo->estado }}</span>
                            @else
                                <span class="badge badge-danger">{{ $equipo->estado }}</span>
                            @endif
                        </dd>

                        <dt class="col-sm-4">Serial</dt>
                        <dd class="col-sm-8">{{ $equipo->serial ?? 'No registrado' }}</dd>
                    </dl>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('equipos.inventario') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
