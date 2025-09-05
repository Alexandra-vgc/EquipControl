@extends('adminlte::page')
@section('title', 'Documentos')

@section('content_header')
    <h1><i class="fas fa-file-pdf"></i> Generar Documentos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-info-circle"></i> Tipos de documentos disponibles</h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h5><i class="icon fas fa-info"></i> Información</h5>
                        Desde aquí puedes acceder a la generación de documentos PDF. 
                        Los documentos se generan automáticamente cuando completas una entrega o devolución.
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-upload"></i> Documentos de Entrega</h3>
                                </div>
                                <div class="card-body">
                                    <p>Generar documentos PDF para entregas de equipos.</p>
                                    <a href="{{ route('editor.entregas.create') }}" class="btn btn-primary btn-block">
                                        <i class="fas fa-file-upload"></i> Crear Documento de Entrega
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-download"></i> Documentos de Devolución</h3>
                                </div>
                                <div class="card-body">
                                    <p>Generar documentos PDF para devoluciones de equipos.</p>
                                    <a href="{{ route('editor.devoluciones.create') }}" class="btn btn-warning btn-block">
                                        <i class="fas fa-file-download"></i> Crear Documento de Devolución
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-history"></i> Accesos Rápidos</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="{{ route('historial.index') }}" class="btn btn-info btn-block">
                                                <i class="fas fa-history"></i> Ver Historial
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{ route('equipos.inventario') }}" class="btn btn-success btn-block">
                                                <i class="fas fa-laptop"></i> Ver Inventario
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{ route('editor.dashboard') }}" class="btn btn-secondary btn-block">
                                                <i class="fas fa-home"></i> Volver al Dashboard
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            border: none;
        }
        
        .card-header {
            border-radius: 8px 8px 0 0 !important;
        }
        
        .alert-info {
            border-left: 4px solid #17a2b8;
        }
        
        .btn-block {
            margin-bottom: 10px;
        }
    </style>
@stop

@section('js')
    <script> 
        console.log("Vista de documentos del editor cargada correctamente.");
    </script>
@stop