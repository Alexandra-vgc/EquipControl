@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-bold text-dark">Panel de Control - EquipControl</h1>
@stop

@section('content')
    {{-- KPIs principales --}}
    <div class="row text-center custom-small-boxes">
        <div class="col-md-3">
            <x-adminlte-small-box 
                title="Equipos Asignados" 
                text="{{ $equiposAsignados }} en uso" 
                icon="fas fa-laptop" 
                theme="success" 
                url="#" 
                url-text="Ver equipos"
                data-toggle="modal" data-target="#modalAsignados"
                class="shadow-lg"/>
        </div>

        <div class="col-md-3">
            <x-adminlte-small-box 
                title="Equipos Disponibles" 
                text="{{ $equiposDisponibles }} libres" 
                icon="fas fa-box-open" 
                theme="info" 
                url="#" 
                url-text="Ver inventario"
                data-toggle="modal" data-target="#modalDisponibles"
                class="shadow-lg"/>
        </div>

        <div class="col-md-3">
            <x-adminlte-small-box 
                title="En Reparación" 
                text="{{ $equiposReparacion }} equipos" 
                icon="fas fa-tools" 
                theme="danger" 
                url="#" 
                url-text="Ver detalles"
                data-toggle="modal" data-target="#modalReparacion"
                class="shadow-lg"/>
        </div>

        <div class="col-md-3">
            <x-adminlte-small-box 
                title="Equipos Dañados" 
                text="{{ $equiposDanados }} equipos" 
                icon="fas fa-exclamation-triangle" 
                theme="dark" 
                url="#" 
                url-text="Ver detalles"
                data-toggle="modal" data-target="#modalDanados"
                class="shadow-lg"/>
        </div>
    </div>

    {{-- 📌 MODALES DE LISTAS --}}
    {{-- Asignados --}}
    <x-adminlte-modal id="modalAsignados" title="Equipos Asignados" theme="success" icon="fas fa-laptop">
        @if($equiposAsignadosLista->isEmpty())
            <p>No hay equipos asignados actualmente.</p>
        @else
            <ul class="list-group">
                @foreach($equiposAsignadosLista as $eq)
                    <li class="list-group-item">
                        {{ $eq->tipo }} - {{ $eq->marca }} ({{ $eq->modelo }})
                    </li>
                @endforeach
            </ul>
        @endif
    </x-adminlte-modal>

    {{-- Disponibles --}}
    <x-adminlte-modal id="modalDisponibles" title="Equipos Disponibles" theme="info" icon="fas fa-box-open">
        @if($equiposDisponiblesLista->isEmpty())
            <p>No hay equipos disponibles actualmente.</p>
        @else
            <ul class="list-group">
                @foreach($equiposDisponiblesLista as $eq)
                    <li class="list-group-item">
                        {{ $eq->tipo }} - {{ $eq->marca }} ({{ $eq->modelo }})
                    </li>
                @endforeach
            </ul>
        @endif
    </x-adminlte-modal>

    {{-- Reparación --}}
    <x-adminlte-modal id="modalReparacion" title="Equipos en Reparación" theme="danger" icon="fas fa-tools">
        @if($equiposReparacionLista->isEmpty())
            <p>No hay equipos en reparación actualmente.</p>
        @else
            <ul class="list-group">
                @foreach($equiposReparacionLista as $eq)
                    <li class="list-group-item">
                        {{ $eq->tipo }} - {{ $eq->marca }} ({{ $eq->modelo }})
                    </li>
                @endforeach
            </ul>
        @endif
    </x-adminlte-modal>

    {{-- Dañados --}}
    <x-adminlte-modal id="modalDanados" title="Equipos Dañados" theme="dark" icon="fas fa-exclamation-triangle">
        @if($equiposDanadosLista->isEmpty())
            <p>No hay equipos dañados actualmente.</p>
        @else
            <ul class="list-group">
                @foreach($equiposDanadosLista as $eq)
                    <li class="list-group-item">
                        {{ $eq->tipo }} - {{ $eq->marca }} ({{ $eq->modelo }})
                    </li>
                @endforeach
            </ul>
        @endif
    </x-adminlte-modal>

    {{-- Listas rápidas --}}
    <div class="row mt-4">
        <div class="col-md-6">
            <x-adminlte-card title="Últimas Entregas" theme="info" icon="fas fa-share-square">
                <ul class="list-group small">
                    @forelse ($ultimasEntregas as $entrega)
                        <li class="list-group-item">
                            {{ $entrega->tipo }} - {{ $entrega->marca }} ({{ $entrega->modelo }}) - 
                            {{ $entrega->updated_at->format('d/m/Y') }}
                        </li>
                    @empty
                        <li class="list-group-item">No hay entregas recientes</li>
                    @endforelse
                </ul>
            </x-adminlte-card>
        </div>

        <div class="col-md-6">
            <x-adminlte-card title="Últimas Devoluciones" theme="lightblue" icon="fas fa-reply">
                <ul class="list-group small">
                    @forelse ($ultimasDevoluciones as $devolucion)
                        <li class="list-group-item">
                            {{ $devolucion->nombre ?? 'Equipo' }} devuelto - {{ $devolucion->updated_at->format('d/m/Y') }}
                        </li>
                    @empty
                        <li class="list-group-item">No hay devoluciones recientes</li>
                    @endforelse
                </ul>
            </x-adminlte-card>
        </div>
    </div>

    {{-- Gráficos --}}
    <div class="row mt-4">
        <div class="col-md-6">
            <x-adminlte-card title="Estado General de los Equipos" theme="warning" icon="fas fa-chart-pie">
                <canvas id="equiposChart" height="100"></canvas>
            </x-adminlte-card>
        </div>

        <div class="col-md-6">
            <x-adminlte-card title="Equipos por Tipo" theme="primary" icon="fas fa-server">
                <canvas id="tipoChart" height="100"></canvas>
            </x-adminlte-card>
        </div>
    </div>
@stop

@section('css')
    <style>
        /* 🎨 Personalización de los cuadros principales */
        .custom-small-boxes .small-box {
            border-radius: 15px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .custom-small-boxes .small-box .inner h3 {
            font-size: 1.5rem; /* número más pequeño */
            font-weight: bold;
        }

        .custom-small-boxes .small-box .inner p {
            font-size: 0.9rem; /* texto más pequeño */
            font-weight: 500;
        }

        .custom-small-boxes .small-box .icon {
            opacity: 0.8;
        }

        .custom-small-boxes .small-box-footer {
            font-size: 0.8rem;
        }

        /* 🌟 Efecto hover bonito */
        .custom-small-boxes .small-box:hover {
            transform: scale(1.05);
            transition: 0.3s ease-in-out;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.2);
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Doughnut estado general
        new Chart(document.getElementById('equiposChart'), {
            type: 'doughnut',
            data: {
                labels: ['Asignados', 'Disponibles', 'En Reparación', 'Dañados'],
                datasets: [{
                    data: [{{ $equiposAsignados }}, {{ $equiposDisponibles }}, {{ $equiposReparacion }}, {{ $equiposDanados }}],
                    backgroundColor: ['#28a745', '#17a2b8', '#dc3545', '#343a40'],
                }]
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
        });

        // Barras por tipo de equipo
        new Chart(document.getElementById('tipoChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($equiposTipo)) !!},
                datasets: [{
                    label: 'Cantidad',
                    data: {!! json_encode(array_values($equiposTipo)) !!},
                    backgroundColor: '#007bff'
                }]
            },
            options: { responsive: true, plugins: { legend: { display: false } } }
        });
    </script>
@stop
