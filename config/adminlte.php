<?php

return [

    'title' => 'EquipControl',
    'title_prefix' => 'Panel | ',
    'title_postfix' => ' | Instituto Sudamericano',

    'use_ico_only' => true,
    'use_full_favicon' => false,

    'google_fonts' => [ 'allowed' => true ],

    'logo' => '<b>Equip</b>Control',
    'logo_img' => 'vendor/adminlte/dist/img/logo.png',
    'logo_img_class' => 'brand-image elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Logo EquipControl',

    'auth_logo' => [
        'enabled' => true,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/logo.png',
            'alt' => 'Auth Logo',
            'class' => 'rounded mx-auto d-block',
            'width' => 60,
            'height' => 60,
        ],
    ],

    'preloader' => [
        'enabled' => false,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/equipcontrol_logo.png',
            'alt' => 'Cargando EquipControl...',
            'effect' => 'animation__shake',
            'width' => 80,
            'height' => 80,
        ],
    ],

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-gradient-primary',
    'usermenu_image' => false,
    'usermenu_desc' => true,
    'usermenu_profile_url' => true,

    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_dark_mode' => false,

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_btn' => 'btn-flat btn-primary',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_topnav' => 'navbar-white navbar-light',

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_scrollbar_theme' => 'os-theme-light',

    'right_sidebar' => false,

    'dashboard_url' => 'dashboard',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',

    'menu' => [
        ['header' => 'GESTIÓN DE EQUIPOS'],
        [
            'text' => 'Solicitudes de Entrega',
            'route'  => 'admin.solicitudes.index',
            'icon' => 'fas fa-file-signature',
            'can'   => 'ver',
        ],
        [
            'text' => 'Equipos Asignados',
            'url'  => 'equipos/asignados',
            'icon' => 'fas fa-laptop',
        ],
        [
            'text' => 'Devoluciones',
            'url'  => 'equipos/devoluciones',
            'icon' => 'fas fa-undo',
        ],

        ['header' => 'GESTIÓN DE EQUIPOS'],
        [
        'text'    => 'Equipos',
        'icon'    => 'fas fa-desktop',
        'submenu' => [
        [
            'text' => 'CPU',
            'route'  => 'equipos.cpu',
            'icon'  => 'fas fa-microchip',
        ],
        [
            'text' => 'Monitor',
            'route'  => 'equipos.monitor',
            'icon'  => 'fas fa-tv',
        ],
        [
            'text' => 'Teclado',
            'route'  => 'equipos.teclado',
            'icon'  => 'fas fa-keyboard',
        ],
        [
            'text' => 'Mouse',
            'route'  => 'equipos.mouse',
            'icon'  => 'fas fa-mouse',
        ],
    ],
],

        [
            'text'  => 'Nuevo Equipo',
            'route' => 'equipos.create',
            'icon'  => 'fas fa-plus-circle', 
        ],

        [
            'text' => 'Nueva Entrega',
            'route' => 'entregas.create',
            'icon'  => 'fas fa-file-signature',
        ],

        [
            'text' => 'Historial',
            'url'  => 'historial',
            'icon' => 'fas fa-history',
        ],

        
        [
            'text' => 'Usuarios',
            'icon' => 'fas fa-users',
            'submenu' => [
        [
            'text' => 'Asignar Rol',
          'route'  => 'admin.usuario.asignar', 
            'icon' => 'fas fa-user-tag',
        ],
    ],
],

        [
            'text'  => 'Contacto',
            'route' => 'contact.index',
            'icon'  => 'fas fa-envelope',
        ],



        

        ['header' => 'CUENTA'],
        [
            'text' => 'Perfil',
            'url'  => 'usuario/perfil',
            'icon' => 'fas fa-user',
        ],
        [
            'text' => 'Cerrar sesión',
            'url'  => 'logout',
            'icon' => 'fas fa-sign-out-alt',
            'method' => 'POST',
        ],
        ],

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    

    'plugins' => [
        'Chartjs' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/chart.js',
                ],
            ],
        ],
    ],

    'livewire' => false,
];
