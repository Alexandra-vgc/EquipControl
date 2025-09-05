@extends('adminlte::page')
@section('title', 'Dashboard Editor')

@section('content_header')
    <h1 class="text-bold text-dark">Panel de Control - EquipControl (Editor)</h1>
@stop

@section('content')
    {{-- CUADRITOS PRINCIPALES --}}
    <div class="row">
        {{-- Registrar nueva entrega --}}
        <div class="col-md-3">
            <x-adminlte-small-box 
                title="Solicitudes de Entrega" 
                text="Registrar nueva entrega" 
                icon="fas fa-clipboard-list" 
                theme="info" 
                url="{{ route('editor.entregas.create') }}" 
                url-text="Registrar entrega"/>
        </div>

        {{-- Ver inventario de equipos --}}
        <div class="col-md-3">
            <x-adminlte-small-box 
                title="Equipos Asignados" 
                text="Ver inventario" 
                icon="fas fa-laptop" 
                theme="success" 
                url="{{ route('equipos.inventario') }}" 
                url-text="Ver equipos"/>
        </div>

        {{-- Registrar devolución --}}
        <div class="col-md-3">
            <x-adminlte-small-box 
                class="box-devoluciones" 
                title="Devoluciones" 
                text="Registrar devolución" 
                icon="fas fa-undo-alt" 
                theme="warning" 
                url="{{ route('editor.devoluciones.create') }}" 
                url-text="Registrar devolución"/>
        </div>

        {{-- Generar documentos --}}
        <div class="col-md-3">
            <x-adminlte-small-box 
                title="Documentos" 
                text="Generar PDF" 
                icon="fas fa-file-alt" 
                theme="danger" 
                url="{{ route('editor.documentos.index') }}" 
                url-text="Generar documento"/>
        </div>
    </div>

    {{-- SEGUNDA FILA CON FUNCIONES ADICIONALES --}}
    <div class="row mt-4">
        {{-- Ver historial --}}
        <div class="col-md-6">
            <x-adminlte-small-box 
                title="Historial" 
                text="Ver historial de movimientos" 
                icon="fas fa-history" 
                theme="primary" 
                url="{{ route('historial.index') }}" 
                url-text="Ver historial"/>
        </div>

        {{-- Contactos --}}
        <div class="col-md-6">
            <x-adminlte-small-box 
                title="Contactos" 
                text="Ver información de contacto" 
                icon="fas fa-address-book" 
                theme="info" 
                url="{{ route('contact.index') }}" 
                url-text="Ver contactos"/>
        </div>
    </div>

    {{-- INFORMACIÓN DE PERMISOS DEL EDITOR --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user-shield"></i> Permisos del Editor
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-success"><i class="fas fa-check"></i> Puedes hacer:</h5>
                            <ul class="list-unstyled text-success">
                                <li><i class="fas fa-plus-circle"></i> Registrar nuevas entregas</li>
                                <li><i class="fas fa-undo"></i> Registrar devoluciones</li>
                                <li><i class="fas fa-file-pdf"></i> Generar documentos PDF</li>
                                <li><i class="fas fa-eye"></i> Ver historial de movimientos</li>
                                <li><i class="fas fa-laptop"></i> Ver inventario de equipos</li>
                                <li><i class="fas fa-address-book"></i> Acceder a contactos</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-danger"><i class="fas fa-times"></i> No puedes hacer:</h5>
                            <ul class="list-unstyled text-danger">
                                <li><i class="fas fa-trash"></i> Eliminar equipos del inventario</li>
                                <li><i class="fas fa-users-cog"></i> Gestionar usuarios</li>
                                <li><i class="fas fa-cogs"></i> Modificar configuraciones del sistema</li>
                                <li><i class="fas fa-user-plus"></i> Crear nuevos usuarios</li>
                                <li><i class="fas fa-shield-alt"></i> Asignar roles y permisos</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ESTADÍSTICAS RÁPIDAS --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title text-white">
                        <i class="fas fa-chart-pie"></i> Vista Rápida del Sistema
                    </h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        <i class="fas fa-info-circle"></i> 
                        Como Editor, tienes acceso completo a las funciones operativas del sistema EquipControl. 
                        Puedes gestionar entregas, devoluciones y generar toda la documentación necesaria.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- FORMULARIO OCULTO PARA LOGOUT --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@stop

@section('css')
    <style>
        body {
            background-color: #467B79 !important;
        }
        
        h1 {
            color: #ffffff;
            font-weight: bold;
            margin-bottom: 20px;
        }
        
        .small-box {
            position: relative;
            padding: 15px;
            min-height: 120px;
            background: linear-gradient(135deg, #467B79, #3e6f6d);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            overflow: hidden;
            cursor: pointer;
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
        
        .card {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            border: none;
        }
        
        .card-header {
            background-color: #467B79 !important;
            color: white !important;
            border-radius: 8px 8px 0 0 !important;
        }
        
        .card-header h3 {
            color: white !important;
        }
        
        .bg-info {
            background-color: #17a2b8 !important;
        }
        
        .text-success {
            color: #28a745 !important;
        }
        
        .text-danger {
            color: #dc3545 !important;
        }
        
        .list-unstyled li {
            padding: 2px 0;
            font-size: 14px;
        }
    </style>
@stop

@section('js')
    <script> 
        console.log("Editor dashboard cargado correctamente - Laravel 9 compatible");
        
        // Verificar si jQuery está disponible
        if (typeof jQuery !== 'undefined') {
            $(document).ready(function() {
                // Mensaje de bienvenida
                @if(session('success'))
                    // Usar SweetAlert si está disponible, sino alert nativo
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: '{{ session("success") }}',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    } else {
                        alert('{{ session("success") }}');
                    }
                @endif
                
                // Efecto hover en los cuadritos
                $('.small-box').on('mouseenter', function() {
                    $(this).addClass('shadow-lg');
                }).on('mouseleave', function() {
                    $(this).removeClass('shadow-lg');
                });
            });
        }
    </script>
@stop