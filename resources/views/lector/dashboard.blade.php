@extends('adminlte::page')

@section('title', 'Panel Lector')

@push('css')
<style>
    /* Variables CSS para tema dinámico */
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --info-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        --glass-bg: rgba(255, 255, 255, 0.1);
        --glass-border: rgba(255, 255, 255, 0.2);
        --text-primary: #2d3748;
        --text-secondary: #718096;
        --shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        --shadow-hover: 0 12px 40px rgba(0, 0, 0, 0.15);
    }

    /* Fondo animado con partículas */
    body.sidebar-mini {
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradientShift 15s ease infinite;
        position: relative;
        overflow-x: hidden;
    }

    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: 
            radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
            radial-gradient(circle at 40% 40%, rgba(120, 200, 255, 0.3) 0%, transparent 50%);
        pointer-events: none;
        z-index: -1;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Animación de partículas flotantes */
    .floating-particles {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
    }

    .particle {
        position: absolute;
        background: rgba(255, 255, 255, 0.6);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    .particle:nth-child(1) { width: 4px; height: 4px; left: 10%; animation-delay: 0s; }
    .particle:nth-child(2) { width: 6px; height: 6px; left: 20%; animation-delay: 1s; }
    .particle:nth-child(3) { width: 3px; height: 3px; left: 30%; animation-delay: 2s; }
    .particle:nth-child(4) { width: 5px; height: 5px; left: 40%; animation-delay: 3s; }
    .particle:nth-child(5) { width: 4px; height: 4px; left: 50%; animation-delay: 4s; }
    .particle:nth-child(6) { width: 7px; height: 7px; left: 60%; animation-delay: 5s; }
    .particle:nth-child(7) { width: 3px; height: 3px; left: 70%; animation-delay: 6s; }
    .particle:nth-child(8) { width: 5px; height: 5px; left: 80%; animation-delay: 7s; }
    .particle:nth-child(9) { width: 4px; height: 4px; left: 90%; animation-delay: 8s; }

    @keyframes float {
        0%, 100% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
        10%, 90% { opacity: 1; }
        50% { transform: translateY(-10vh) rotate(180deg); }
    }

    /* Header personalizado */
    .content-header {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        margin: 20px 15px;
        padding: 30px;
        box-shadow: var(--shadow);
        position: relative;
        overflow: hidden;
    }

    .content-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: conic-gradient(from 0deg, transparent, rgba(255,255,255,0.1), transparent);
        animation: rotate 10s linear infinite;
        pointer-events: none;
    }

    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .content-header h1 {
        font-size: 3rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea, #764ba2, #f093fb);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
        text-align: center;
        text-shadow: 0 0 30px rgba(102, 126, 234, 0.5);
        position: relative;
        z-index: 2;
        animation: textGlow 3s ease-in-out infinite alternate;
    }

    @keyframes textGlow {
        from { filter: brightness(1); }
        to { filter: brightness(1.2); }
    }

    /* Cards con efecto glassmorphism mejorado */
    .modern-card {
        background: var(--glass-bg);
        backdrop-filter: blur(25px);
        border: 1px solid var(--glass-border);
        border-radius: 25px;
        padding: 30px;
        margin: 20px 0;
        box-shadow: var(--shadow);
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        min-height: 280px;
    }

    .modern-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.6s;
    }

    .modern-card:hover::before {
        left: 100%;
    }

    .modern-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: var(--shadow-hover);
        border-color: rgba(255, 255, 255, 0.4);
    }

    /* Títulos de cards */
    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 15px;
        position: relative;
        z-index: 2;
        padding-bottom: 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .card-title.primary { color: #667eea; }
    .card-title.info { color: #43e97b; }

    /* Iconos con animación */
    .card-icon {
        width: 50px;
        height: 50px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        animation: iconPulse 2s ease-in-out infinite;
        position: relative;
    }

    .card-icon.primary { background: var(--primary-gradient); }
    .card-icon.info { background: var(--info-gradient); }

    @keyframes iconPulse {
        0%, 100% { transform: scale(1); box-shadow: 0 0 20px rgba(102, 126, 234, 0.4); }
        50% { transform: scale(1.1); box-shadow: 0 0 30px rgba(102, 126, 234, 0.6); }
    }

    /* Contenido de las cards */
    .card-content {
        position: relative;
        z-index: 2;
        margin-top: 20px;
    }

    .card-content .description-text {
        margin: 20px 0 30px 0;
        font-style: italic;
        color: #718096;
        font-size: 0.95rem;
        line-height: 1.6;
        padding: 15px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        border-left: 3px solid #667eea;
    }

    .card-content p {
        margin: 15px 0;
        font-size: 1rem;
        color: var(--text-primary);
        font-weight: 500;
        line-height: 1.6;
    }

    .card-content strong {
        color: var(--text-primary);
        font-weight: 600;
    }

    .card-content ul {
        list-style: none;
        padding: 0;
        margin-top: 20px;
    }

    .card-content li {
        margin: 10px 0;
        padding: 15px 20px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 12px;
        border-left: 4px solid #43e97b;
        font-weight: 500;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .card-content li:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateX(8px) scale(1.02);
        box-shadow: 0 8px 25px rgba(67, 233, 123, 0.3);
        border-left-width: 6px;
    }

    /* Efectos de interacción */
    .interactive-element {
        position: relative;
        overflow: hidden;
    }

    .interactive-element::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
        transition: all 0.6s ease;
        transform: translate(-50%, -50%);
        pointer-events: none;
    }

    .interactive-element:hover::after {
        width: 200px;
        height: 200px;
    }

    /* Footer mejorado */
    .custom-footer {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        margin: 20px 15px;
        padding: 25px;
        text-align: center;
        box-shadow: var(--shadow);
        position: relative;
        background-image: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, transparent 100%);
    }

    .custom-footer small {
        font-size: 1rem;
        color: var(--text-primary);
        font-weight: 600;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Animaciones de entrada */
    .animate-in {
        opacity: 0;
        transform: translateY(30px);
        animation: slideIn 0.8s ease forwards;
    }

    .animate-in:nth-child(1) { animation-delay: 0.1s; }
    .animate-in:nth-child(2) { animation-delay: 0.3s; }

    @keyframes slideIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .content-header h1 {
            font-size: 2rem;
        }
        
        .modern-card {
            margin: 10px 0;
            padding: 20px;
        }
        
        .card-title {
            font-size: 1.3rem;
        }
    }
</style>
@endpush

@section('content_header')
    <h1>🎓 Bienvenido, Lector</h1>
    <!-- Partículas flotantes -->
    <div class="floating-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 animate-in">
            <div class="modern-card interactive-element">
                <div class="card-title primary">
                    <div class="card-icon primary">
                        <i class="fas fa-university"></i>
                    </div>
                    <span>Información del Instituto</span>
                </div>
                <div class="card-content">
                    <div class="description-text">
                        Conoce más detalles sobre nuestra institución educativa:
                    </div>
                    <p><strong>🏛️ Nombre:</strong> Instituto Superior Tecnológico</p>
                    <p><strong>📍 Dirección:</strong> Av. Siempre Viva 123, Ciudad</p>
                    <p><strong>📞 Teléfono:</strong> (02) 555-1234</p>
                    <p><strong>✉️ Email:</strong> contacto@instituto.edu.ec</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 animate-in">
            <div class="modern-card interactive-element">
                <div class="card-title info">
                    <div class="card-icon info">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <span>Contáctanos</span>
                </div>
                <div class="card-content">
                    <div class="description-text">
                        Si necesitas más información o tienes alguna consulta, no dudes en contactarnos a través de:
                    </div>
                    <ul>
                        <li>📱 WhatsApp: +593 987654321</li>
                        <li>📧 Correo: soporte@instituto.edu.ec</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <div class="custom-footer">
        <small>&copy; {{ date('Y') }} Instituto Superior Tecnológico Sudamericano | Excelencia Académica</small>
    </div>
@stop

@section('js')
    <script>
        console.log("Lector dashboard cargado correctamente - Laravel 9 compatible");
        
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

        // FUNCIÓN DE LOGOUT PARA LECTOR
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Configurando logout para Lector...');
            
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
                        console.log('Lector logout configurado:', newLink.textContent.trim());
                    }
                });
                
                console.log(`Lector: ${found} enlaces de logout configurados`);
            }, 1000);

            // Efectos visuales del dashboard
            setTimeout(function() {
                // Efecto de hover mejorado para las cards
                const cards = document.querySelectorAll('.modern-card');
                
                cards.forEach(card => {
                    card.addEventListener('mouseenter', function() {
                        this.style.transform = 'translateY(-10px) scale(1.02)';
                    });
                    
                    card.addEventListener('mouseleave', function() {
                        this.style.transform = 'translateY(0) scale(1)';
                    });
                });

                // Efecto de click con ondas
                cards.forEach(card => {
                    card.addEventListener('click', function(e) {
                        const ripple = document.createElement('div');
                        const rect = this.getBoundingClientRect();
                        const size = Math.max(rect.width, rect.height);
                        const x = e.clientX - rect.left - size / 2;
                        const y = e.clientY - rect.top - size / 2;
                        
                        ripple.style.width = ripple.style.height = size + 'px';
                        ripple.style.left = x + 'px';
                        ripple.style.top = y + 'px';
                        ripple.style.position = 'absolute';
                        ripple.style.borderRadius = '50%';
                        ripple.style.background = 'rgba(255, 255, 255, 0.3)';
                        ripple.style.transform = 'scale(0)';
                        ripple.style.animation = 'ripple 0.6s ease-out';
                        ripple.style.pointerEvents = 'none';
                        
                        this.appendChild(ripple);
                        
                        setTimeout(() => {
                            ripple.remove();
                        }, 600);
                    });
                });

                // CSS para la animación de ripple
                const style = document.createElement('style');
                style.textContent = `
                    @keyframes ripple {
                        to {
                            transform: scale(2);
                            opacity: 0;
                        }
                    }
                `;
                document.head.appendChild(style);
            }, 500);
        });
    </script>
@stop