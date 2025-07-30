@extends('adminlte::page')

@section('title', 'Solicitudes de Entrega')

@section('content_header')
    <h1>Solicitudes de Entrega</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de Solicitudes</h3>
        </div>
        <div class="card-body">
            <p>Aquí aparecerán las solicitudes de entrega de equipos realizadas por los usuarios.</p>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Usuario</th>
                        <th>Equipo</th>
                        <th>Fecha de solicitud</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Juan Pérez</td>
                        <td>Laptop HP Probook</td>
                        <td>2025-07-30</td>
                        <td><span class="badge bg-warning">Pendiente</span></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Ana Torres</td>
                        <td>Monitor Samsung</td>
                        <td>2025-07-29</td>
                        <td><span class="badge bg-success">Aprobada</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
