@extends('adminlte::page')
@section('title', 'Dashboard Editor')

@section('content_header')
    <div class="content-header-modern">
        <h1 class="text-bold text-dark animated-title">
            <i class="fas fa-tachometer-alt mr-2"></i>
            Panel de Control - EquipControl 
            <span class="badge badge-editor ml-2">Editor</span>
        </h1>
        <p class="subtitle">Gestiona equipos, entregas y documentación de manera eficiente</p>
    </div>
@stop

@section('content')
    {{-- CUADRITOS PRINCIPALES CON DISEÑO MEJORADO --}}
    <div class="row mb-4">
        {{-- Registrar nueva entrega --}}
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card-modern card-entrega" onclick="window.location='{{ route('editor.entregas.create') }}'">
                <div class="card-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="card-content">
                    <h4>Solicitudes de Entrega</h4>
                    <p>Registrar nueva entrega</p>
                    <div class="card-action">
                        <span>Registrar entrega <i class="fas fa-arrow-right ml-2"></i></span>
                    </div>
                </div>
                <div class="card-overlay"></div>
            </div>
        </div>

        {{-- Ver inventario de equipos --}}
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card-modern card-equipos" onclick="window.location='{{ route('equipos.inventario') }}'">
                <div class="card-icon">
                    <i class="fas fa-laptop"></i>
                </div>
                <div class="card-content">
                    <h4>Equipos Asignados</h4>
                    <p>Ver inventario completo</p>
                    <div class="card-action">
                        <span>Ver equipos <i class="fas fa-arrow-right ml-2"></i></span>
                    </div>
                </div>
                <div class="card-overlay"></div>
            </div>
        </div>

        {{-- Registrar devolución --}}
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card-modern card-devoluciones" onclick="window.location='{{ route('editor.devoluciones.create') }}'">
                <div class="card-icon">
                    <i class="fas fa-undo-alt"></i>
                </div>
                <div class="card-content">
                    <h4>Devoluciones</h4>
                    <p>Registrar devolución</p>
                    <div class="card-action">
                        <span>Registrar devolución <i class="fas fa-arrow-right ml-2"></i></span>
                    </div>
                </div>
                <div class="card-overlay"></div>
            </div>
        </div>

        {{-- Generar documentos --}}
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card-modern card-documentos" onclick="window.location='{{ route('editor.documentos.index') }}'">
                <div class="card-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="card-content">
                    <h4>Documentos</h4>
                    <p>Generar PDF y reportes</p>
                    <div class="card-action">
                        <span>Generar documento <i class="fas fa-arrow-right ml-2"></i></span>
                    </div>
                </div>
                <div class="card-overlay"></div>
            </div>
        </div>
    </div>

    {{-- SEGUNDA FILA CON FUNCIONES ADICIONALES --}}
    <div class="row mb-4">
        {{-- Ver historial --}}
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card-modern card-wide card-historial" onclick="window.location='{{ route('historial.index') }}'">
                <div class="card-icon">
                    <i class="fas fa-history"></i>
                </div>
                <div class="card-content">
                    <h4>Historial de Movimientos</h4>
                    <p>Consulta todo el historial de entregas y devoluciones del sistema</p>
                    <div class="card-action">
                        <span>Ver historial completo <i class="fas fa-arrow-right ml-2"></i></span>
                    </div>
                </div>
                <div class="card-overlay"></div>
            </div>
        </div>

        {{-- Contactos --}}
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card-modern card-wide card-contactos" onclick="window.location='{{ route('contact.index') }}'">
                <div class="card-icon">
                    <i class="fas fa-address-book"></i>
                </div>
                <div class="card-content">
                    <h4>Información de Contacto</h4>
                    <p>Accede a la información de contacto de usuarios y departamentos</p>
                    <div class="card-action">
                        <span>Ver contactos <i class="fas fa-arrow-right ml-2"></i></span>
                    </div>
                </div>
                <div class="card-overlay"></div>
            </div>
        </div>
    </div>

    {{-- INFORMACIÓN DE PERMISOS DEL EDITOR MEJORADA --}}
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="permissions-card">
                <div class="permissions-header">
                    <div class="permissions-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="permissions-title">
                        <h3>Permisos del Editor</h3>
                        <p>Tu nivel de acceso en el sistema</p>
                    </div>
                </div>
                <div class="permissions-body">
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="permission-section permission-allowed">
                                <h5><i class="fas fa-check-circle"></i> Acciones Permitidas</h5>
                                <div class="permission-list">
                                    <div class="permission-item">
                                        <i class="fas fa-plus-circle"></i>
                                        <span>Registrar nuevas entregas</span>
                                    </div>
                                    <div class="permission-item">
                                        <i class="fas fa-undo"></i>
                                        <span>Registrar devoluciones</span>
                                    </div>
                                    <div class="permission-item">
                                        <i class="fas fa-file-pdf"></i>
                                        <span>Generar documentos PDF</span>
                                    </div>
                                    <div class="permission-item">
                                        <i class="fas fa-eye"></i>
                                        <span>Ver historial de movimientos</span>
                                    </div>
                                    <div class="permission-item">
                                        <i class="fas fa-laptop"></i>
                                        <span>Ver inventario de equipos</span>
                                    </div>
                                    <div class="permission-item">
                                        <i class="fas fa-edit"></i>
                                        <span>Editar información de equipos</span>
                                    </div>
                                    <div class="permission-item">
                                        <i class="fas fa-address-book"></i>
                                        <span>Acceder a contactos</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="permission-section permission-denied">
                                <h5><i class="fas fa-times-circle"></i> Acciones Restringidas</h5>
                                <div class="permission-list">
                                    <div class="permission-item">
                                        <i class="fas fa-trash"></i>
                                        <span>Eliminar equipos del inventario</span>
                                    </div>
                                    <div class="permission-item">
                                        <i class="fas fa-users-cog"></i>
                                        <span>Gestionar usuarios</span>
                                    </div>
                                    <div class="permission-item">
                                        <i class="fas fa-cogs"></i>
                                        <span>Modificar configuraciones del sistema</span>
                                    </div>
                                    <div class="permission-item">
                                        <i class="fas fa-user-plus"></i>
                                        <span>Crear nuevos usuarios</span>
                                    </div>
                                    <div class="permission-item">
                                        <i class="fas fa-shield-alt"></i>
                                        <span>Asignar roles y permisos</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- VISTA RÁPIDA DEL SISTEMA MEJORADA --}}
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="info-card">
                <div class="info-header">
                    <i class="fas fa-info-circle"></i>
                    <h3>Vista Rápida del Sistema</h3>
                </div>
                <div class="info-content">
                    <div class="info-text">
                        <p>Como <strong>Editor</strong>, tienes acceso completo a las funciones operativas del sistema EquipControl. Puedes gestionar entregas, devoluciones y generar toda la documentación necesaria para el correcto funcionamiento del inventario.</p>
                    </div>
                    <div class="info-stats">
                        <div class="stat-item">
                            <i class="fas fa-users"></i>
                            <span>Usuarios Activos</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-laptop"></i>
                            <span>Equipos en Sistema</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-exchange-alt"></i>
                            <span>Movimientos del Mes</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            });
        }

        // FUNCIÓN DE LOGOUT PARA EDITOR
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Configurando logout para Editor...');
            
            // Función para hacer logout
            function doLogout(e) {
                if (e) e.preventDefault();
                
                const form = document.getElementById('logout-form');
                if (form) {
                    if (confirm('¿Estás seguro de que deseas cerrar sesión?')) {
                        form.submit();
                    }
                } else {
                    console.error('Formulario logout no encontrado');
                }
            }
            
            // Buscar enlaces de logout después de 1 segundo
            setTimeout(function() {
                const allSidebarLinks = document.querySelectorAll('.sidebar a, .main-sidebar a, .nav-sidebar a, a[id="logout-link"]');
                
                let found = 0;
                allSidebarLinks.forEach(function(link) {
                    const text = link.textContent.trim().toLowerCase();
                    const onclick = link.getAttribute('onclick') || '';
                    
                    if (text.includes('cerrar sesión') || 
                        text.includes('logout') || 
                        text.includes('salir') ||
                        onclick.includes('logout-form') ||
                        link.id === 'logout-link') {
                        
                        // Limpiar eventos anteriores
                        link.removeAttribute('onclick');
                        link.href = '#';
                        
                        // Clonar para remover eventos existentes
                        const newLink = link.cloneNode(true);
                        link.parentNode.replaceChild(newLink, link);
                        
                        // Agregar nuevo evento
                        newLink.addEventListener('click', doLogout);
                        
                        found++;
                        console.log('Editor logout configurado:', newLink.textContent.trim());
                    }
                });
                
                console.log(`Editor: ${found} enlaces de logout configurados`);
            }, 1000);
        });
    </script>
@stop

    {{-- FORMULARIO OCULTO PARA LOGOUT --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@stop

@section('css')
    <style>
        /* VARIABLES CSS PARA COLORES */
        :root {
            --primary-color: #467B79;
            --primary-dark: #3e6f6d;
            --primary-light: #5a8e8b;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
            --light-bg: #f8f9fa;
            --white: #ffffff;
            --text-dark: #2c3e50;
            --text-muted: #6c757d;
            --shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* ESTILOS GENERALES */
        body {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%) !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .content-wrapper {
            background: transparent !important;
        }

        /* HEADER MEJORADO */
        .content-header-modern {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px 30px;
            margin-bottom: 30px;
            box-shadow: var(--shadow);
        }

        .animated-title {
            color: var(--text-dark) !important;
            font-size: 28px;
            margin-bottom: 5px;
            animation: slideInFromTop 0.8s ease-out;
        }

        .badge-editor {
            background: linear-gradient(45deg, var(--primary-color), var(--primary-light));
            color: var(--white);
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .subtitle {
            color: var(--text-muted);
            font-size: 16px;
            margin: 0;
        }

        /* TARJETAS MODERNAS */
        .card-modern {
            background: var(--white);
            border-radius: 20px;
            padding: 30px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
            height: 220px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-modern:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-hover);
        }

        .card-modern .card-icon {
            position: absolute;
            top: -20px;
            right: -20px;
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, var(--primary-color), var(--primary-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.1;
            transition: all 0.3s ease;
        }

        .card-modern:hover .card-icon {
            opacity: 0.15;
            transform: scale(1.1) rotate(10deg);
        }

        .card-modern .card-icon i {
            font-size: 40px;
            color: var(--white);
        }

        .card-modern .card-content h4 {
            color: var(--text-dark);
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
        }

        .card-modern .card-content p {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .card-modern .card-action {
            position: relative;
            z-index: 2;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        .card-modern:hover .card-action {
            opacity: 1;
            transform: translateY(0);
        }

        .card-modern .card-action span {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 14px;
        }

        /* TARJETAS ANCHAS */
        .card-wide {
            height: 180px;
        }

        .card-wide .card-content p {
            font-size: 15px;
            line-height: 1.5;
        }

        /* COLORES ESPECÍFICOS PARA CADA TARJETA */
        .card-entrega:hover {
            background: linear-gradient(135deg, rgba(107, 192, 189, 0.67), rgba(242, 247, 246, 0.66));
        }

        .card-equipos:hover {
            background: linear-gradient(135deg, rgba(68, 218, 103, 0.94), rgba(214, 252, 223, 0.99));
        }

        .card-devoluciones:hover {
            background: linear-gradient(135deg, rgba(180, 144, 33, 0.05), rgba(248, 229, 171, 0.97));
        }

        .card-documentos:hover {
            background: linear-gradient(135deg, rgba(248, 161, 170, 0.93), rgba(245, 162, 170, 0.97));
        }

        .card-historial:hover {
            background: linear-gradient(135deg, rgba(47, 196, 219, 0.92), rgba(155, 228, 240, 0.99));
        }

        .card-contactos:hover {
            background: linear-gradient(135deg, rgba(70, 197, 219, 0.9), rgba(195, 212, 226, 0.93));
        }

        /* TARJETA DE PERMISOS MEJORADA */
        .permissions-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
        }

        .permissions-card:hover {
            box-shadow: var(--shadow-hover);
        }

        .permissions-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            padding: 25px 30px;
            display: flex;
            align-items: center;
            color: var(--white);
        }

        .permissions-icon {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
        }

        .permissions-icon i {
            font-size: 24px;
            color: var(--white);
        }

        .permissions-title h3 {
            color: var(--white) !important;
            font-size: 24px;
            font-weight: 700;
            margin: 0;
        }

        .permissions-title p {
            color: rgba(255, 255, 255, 0.8);
            margin: 5px 0 0 0;
            font-size: 14px;
        }

        .permissions-body {
            padding: 30px;
        }

        .permission-section {
            background: var(--light-bg);
            border-radius: 15px;
            padding: 25px;
            height: 100%;
        }

        .permission-section h5 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .permission-section h5 i {
            margin-right: 10px;
            font-size: 20px;
        }

        .permission-allowed h5 {
            color: var(--success-color);
        }

        .permission-denied h5 {
            color: var(--danger-color);
        }

        .permission-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
        }

        .permission-item:last-child {
            border-bottom: none;
        }

        .permission-item:hover {
            transform: translateX(5px);
        }

        .permission-item i {
            width: 20px;
            margin-right: 12px;
            font-size: 14px;
        }

        .permission-allowed .permission-item i {
            color: var(--success-color);
        }

        .permission-denied .permission-item i {
            color: var(--danger-color);
        }

        .permission-item span {
            font-size: 14px;
            color: var(--text-dark);
        }

        /* TARJETA DE INFORMACIÓN */
        .info-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .info-header {
            background: linear-gradient(135deg, var(--info-color), #20c0d8);
            padding: 20px 30px;
            color: var(--white);
            display: flex;
            align-items: center;
        }

        .info-header i {
            font-size: 24px;
            margin-right: 15px;
        }

        .info-header h3 {
            color: var(--white) !important;
            margin: 0;
            font-size: 20px;
            font-weight: 700;
        }

        .info-content {
            padding: 30px;
        }

        .info-text p {
            color: var(--text-muted);
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .info-stats {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
            color: var(--text-muted);
            padding: 15px;
            border-radius: 10px;
            background: var(--light-bg);
            margin: 5px;
            flex: 1;
            min-width: 150px;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-item i {
            font-size: 24px;
            color: var(--primary-color);
            display: block;
            margin-bottom: 10px;
        }

        .stat-item span {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ANIMACIONES */
        @keyframes slideInFromTop {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .content-header-modern {
                padding: 20px;
                text-align: center;
            }

            .animated-title {
                font-size: 24px;
            }

            .card-modern {
                height: auto;
                min-height: 180px;
                margin-bottom: 20px;
            }

            .permissions-header {
                flex-direction: column;
                text-align: center;
            }

            .permissions-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }

            .info-stats {
                flex-direction: column;
            }
        }

        /* EFECTOS ADICIONALES */
        .card-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .card-modern:hover::before {
            left: 100%;
        }

        /* SCROLL SUAVE */
        html {
            scroll-behavior: smooth;
        }

        /* LOADING STATES */
        .card-modern.loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .card-modern.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 20px;
            height: 20px;
            border: 2px solid var(--primary-color);
            border-top: 2px solid transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }
    </style>
@stop

@section('js')
    <script> 
        console.log("Dashboard Editor Mejorado - Cargado correctamente");
        
        // INICIALIZACIÓN DEL DASHBOARD
        document.addEventListener('DOMContentLoaded', function() {
            
            // Animación de entrada para las tarjetas
            function animateCards() {
                const cards = document.querySelectorAll('.card-modern, .permissions-card, .info-card');
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry, index) => {
                        if (entry.isIntersecting) {
                            setTimeout(() => {
                                entry.target.style.animation = `fadeInUp 0.6s ease forwards`;
                                entry.target.style.opacity = '1';
                            }, index * 100);
                        }
                    });
                }, { threshold: 0.1 });

                cards.forEach(card => {
                    card.style.opacity = '0';
                    observer.observe(card);
                });
            }

            // Efecto de clic en las tarjetas
            function addCardClickEffects() {
                const cards = document.querySelectorAll('.card-modern');
                
                cards.forEach(card => {
                    card.addEventListener('click', function(e) {
                        // Efecto ripple
                        const ripple = document.createElement('div');
                        const rect = this.getBoundingClientRect();
                        const size = Math.max(rect.width, rect.height);
                        const x = e.clientX - rect.left - size / 2;
                        const y = e.clientY - rect.top - size / 2;
                        
                        ripple.style.cssText = `
                            position: absolute;
                            width: ${size}px;
                            height: ${size}px;
                            left: ${x}px;
                            top: ${y}px;
                            background: rgba(255, 255, 255, 0.3);
                            border-radius: 50%;
                            transform: scale(0);
                            animation: ripple 0.6s ease-out;
                            pointer-events: none;
                            z-index: 1000;
                        `;
                        
                        this.appendChild(ripple);
                        
                        setTimeout(() => {
                            ripple.remove();
                        }, 600);
                    });
                });
            }

            // Loading state para las tarjetas
            function addLoadingStates() {
                const cards = document.querySelectorAll('.card-modern[onclick]');
                
                cards.forEach(card => {
                    card.addEventListener('click', function() {
                        this.classList.add('loading');
                        
                        setTimeout(() => {
                            this.classList.remove('loading');
                        }, 1500);
                    });
                });
            }

            // Inicializar todas las funciones
            animateCards();
            addCardClickEffects();
            addLoadingStates();

            // Mensaje de bienvenida mejorado
            @if(session('success'))
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Bienvenido!',
                        text: '{{ session("success") }}',
                        timer: 4000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end',
                        background: '#ffffff',
                        color: '#2c3e50',
                        iconColor: '#28a745'
                    });
                } else {
                    // Notificación personalizada si no hay SweetAlert
                    const notification = document.createElement('div');
                    notification.style.cssText = `
                        position: fixed;
                        top: 20px;
                        right: 20px;
                        background: #28a745;
                        color: white;
                        padding: 15px 20px;
                        border-radius: 10px;
                        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                        z-index: 10000;
                        font-weight: 600;
                        opacity: 0;
                        transform: translateX(100px);
                        transition: all 0.3s ease;
                    `;
                    notification.textContent = '{{ session("success") }}';
                    
                    document.body.appendChild(notification);
                    
                    setTimeout(() => {
                        notification.style.opacity = '1';
                        notification.style.transform = 'translateX(0)';
                    }, 100);
                    
                    setTimeout(() => {
                        notification.style.opacity = '0';
                        notification.style.transform = 'translateX(100px)';
                        setTimeout(() => notification.remove(), 300);
                    }, 4000);
                }
            @endif
        });

        // CSS adicional para el efecto ripple
        const rippleStyle = document.createElement('style');
        rippleStyle.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(rippleStyle);

        // FUNCIÓN DE LOGOUT MEJORADA
        function doLogout(e) {
            if (e) e.preventDefault();
            
            const form = document.getElementById('logout-form');
            if (form) {
                if (confirm('¿Estás seguro de que deseas cerrar sesión?')) {
                    form.submit();
                }
            } else {
                console.error('No se encontró el formulario de logout');
            }
        }
        
        // Buscar enlaces del sidebar específicamente
        setTimeout(function() {
            const allSidebarLinks = document.querySelectorAll('.sidebar a, .main-sidebar a, [data-widget="pushmenu"] ~ * a');
            
            allSidebarLinks.forEach(function(link) {
                const text = link.textContent.trim().toLowerCase();
                
                if (text.includes('cerrar sesión') || 
                    text.includes('logout') || 
                    text.includes('salir') ||
                    link.getAttribute('onclick') && link.getAttribute('onclick').includes('logout-form')) {
                    
                    // Limpiar eventos anteriores
                    link.removeAttribute('onclick');
                    link.href = '#';
                    
                    // Clonar el elemento para remover todos los event listeners
                    const newLink = link.cloneNode(true);
                    link.parentNode.replaceChild(newLink, link);
                    
                    // Agregar el nuevo evento
                    newLink.addEventListener('click', doLogout);
                    
                    console.log('Logout event attached to:', newLink.textContent.trim());
                }
            });
        }, 1000);
    </script>
@stop