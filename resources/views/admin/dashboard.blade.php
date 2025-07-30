@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-bold text-dark">Panel de Control - EquipControl </h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            
            <x-adminlte-small-box title="Solicitudes de Entrega" text="Ver solicitudes" icon="fas fa-clipboard-list" theme="info" url="{{ route('admin.solicitudes.index') }}" url-text="Ver solicitudes"/>
            
        </div>
        <div class="col-md-3">
            <x-adminlte-small-box title="Equipos Asignados" text="38 en uso" icon="fas fa-laptop" theme="success" url="#" url-text="Ver equipos"/>
        </div>
        <div class="col-md-3">
            <x-adminlte-small-box class="box-devoluciones" title="Devoluciones Pendientes" text="6 equipos" icon="fas fa-undo-alt" theme="warning" url="#" url-text="Ver devoluciones"/>
        </div>
        <div class="col-md-3">
            <x-adminlte-small-box title="Documentos Generados" text="22 documentos" icon="fas fa-file-alt" theme="danger" url="#" url-text="Ver reportes"/>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <x-adminlte-card title="Últimas Entregas" theme="info" icon="fas fa-share-square">
                <ul class="list-group">
                    <li class="list-group-item">Equipo HP asignado a Noelia - 07/07/2025</li>
                    <li class="list-group-item">Laptop Lenovo a Colton - 07/07/2025</li>
                    <li class="list-group-item">Monitor Samsung a Gregory - 06/07/2025</li>
                </ul>
            </x-adminlte-card>
        </div>

        <div class="col-md-6">
            <x-adminlte-card title="Últimas Devoluciones" theme="lightblue" icon="fas fa-reply">
                <ul class="list-group">
                    <li class="list-group-item">Teclado Logitech devuelto por Enid - 06/07/2025</li>
                    <li class="list-group-item">Mouse HP devuelto por Juan - 05/07/2025</li>
                </ul>
            </x-adminlte-card>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <x-adminlte-card title="Resumen General de Equipos" theme="warning" icon="fas fa-database">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Equipo</th>
                            <th>Usuario</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>001</td>
                            <td>Laptop Dell</td>
                            <td>Noelia O'Kon</td>
                            <td><span class="badge bg-success">Entregado</span></td>
                            <td>07/07/2025</td>
                        </tr>
                        <tr>
                            <td>002</td>
                            <td>Monitor LG</td>
                            <td>Gregory V.</td>
                            <td><span class="badge bg-warning">Pendiente Devolución</span></td>
                            <td>06/07/2025</td>
                        </tr>
                        <tr>
                            <td>003</td>
                            <td>Teclado Logitech</td>
                            <td>Enid von PhD</td>
                            <td><span class="badge bg-danger">Devuelto</span></td>
                            <td>05/07/2025</td>
                        </tr>
                    </tbody>
                </table>
            </x-adminlte-card>
        </div>
    </div>
@stop

@section('css')
    <style>
        /* Fondo general */
        body {
            background-color: #467B79 !important;
        }

        /* Título principal */
        h1 {
            color: #ffffff;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Estilo general para las tarjetas */
        .small-box {
            position: relative;
            padding: 15px;
            min-height: 120px;
            background: linear-gradient(135deg, #467B79, #3e6f6d);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            overflow: hidden;
        }

        .small-box .inner h3,
        .small-box .inner p,
        .small-box-footer {
            color: #ffffff !important;
            z-index: 2;
            position: relative;
            font-size: 16px;
        }

        .small-box .icon {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 60px;
            color: rgba(255, 255, 255, 0.08);
            z-index: 1;
        }

        .small-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.25);
        }

        /* Texto blanco específico solo para Devoluciones Pendientes */
        .box-devoluciones .inner h3,
        .box-devoluciones .inner p,
        .box-devoluciones .small-box-footer {
            color: #ffffff !important;
        }

        /* (Opcional) Estilos para futuras tarjetas o tablas */
        .card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #467B79;
            color: #ffffff;
            font-weight: bold;
        }

        table.table {
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
        }

        table.table thead {
            background-color: #3e6f6d;
            color: white;
        }

        table.table tbody tr:hover {
            background-color: #f2f2f2;
        }
    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the laravel-AdminLTE package!");</script>
@stop 
