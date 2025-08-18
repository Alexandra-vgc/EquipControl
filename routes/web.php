<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\SolicitudEntregaController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\Admin\DevolucionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Ruta raíz redirige al login
Route::get('/', function () {
     return redirect()->route('login');
});

// Rutas de autenticación Laravel
Auth::routes(['register' => true]);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Ruta genérica dashboard que redirige según rol
Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->hasRole('editor')) {
        return redirect()->route('editor.dashboard');
    } elseif ($user->hasRole('lector')) {
        return redirect()->route('lector.dashboard');
    } else {
        Auth::logout();
        return redirect('/login')->with('error', 'Rol no asignado.');
    }
})->middleware('auth')->name('dashboard');

// Dashboards por rol
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');
Route::middleware(['auth', 'role:editor'])->get('/editor/dashboard', function(){ return view('editor.dashboard'); })->name('editor.dashboard');
Route::middleware(['auth', 'role:lector'])->get('/lector/dashboard', function(){ return view('lector.dashboard'); })->name('lector.dashboard');

// Rutas de contenido con permisos
Route::middleware(['auth'])->group(function () {
    Route::get('/contenido', [\App\Http\Controllers\ContenidoController::class, 'index'])->middleware('permission:ver');
    Route::get('/contenido/crear', [\App\Http\Controllers\ContenidoController::class, 'create'])->middleware('permission:crear');
    Route::post('/contenido', [\App\Http\Controllers\ContenidoController::class, 'store'])->middleware('permission:crear');
    Route::get('/contenido/{id}/editar', [\App\Http\Controllers\ContenidoController::class, 'edit'])->middleware('permission:editar');
    Route::delete('/contenido/{id}', [\App\Http\Controllers\ContenidoController::class, 'destroy'])->middleware('permission:eliminar');
});

// Módulo Contact
Route::middleware(['auth'])->group(function () {
    Route::get('/contact', [ContactController::class, 'show'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
});

// Perfil de usuario
Route::middleware(['auth'])->group(function () {
    Route::get('usuario/perfil', [UsuarioController::class, 'editarPerfil'])->name('usuario.perfil');
    Route::post('usuario/perfil', function (Illuminate\Http\Request $request) {
        return redirect()->back()->with('success', 'Datos guardados');
    })->name('usuario.perfil.guardar');
});

// Rutas del admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Usuarios
    Route::get('/usuario/asignar', [UsuarioController::class, 'asignar'])->name('usuario.asignar');
    Route::post('/usuario/asignar', [UsuarioController::class, 'asignarRol'])->name('usuario.asignar.store');

    // Admin CRUD
    Route::get('/crear', [AdminController::class, 'create'])->name('crear');
    Route::post('/guardar', [AdminController::class, 'store'])->name('guardar');
    Route::get('/editar/{id}', [AdminController::class, 'edit'])->name('editar');
    Route::put('/actualizar/{id}', [AdminController::class, 'update'])->name('actualizar');
    Route::delete('/eliminar/{id}', [AdminController::class, 'destroy'])->name('eliminar');

    // Solicitudes
    Route::prefix('solicitudes')->name('solicitudes.')->group(function () {
        Route::get('/', [SolicitudEntregaController::class, 'index'])->name('index');
        Route::get('/crear', [SolicitudEntregaController::class, 'create'])->name('create');
        Route::post('/', [SolicitudEntregaController::class, 'store'])->name('store');
        Route::get('/{id}/editar', [SolicitudEntregaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SolicitudEntregaController::class, 'update'])->name('update');
        Route::delete('/{id}', [SolicitudEntregaController::class, 'destroy'])->name('destroy');
    });

    // Devoluciones
    Route::prefix('devoluciones')->name('devoluciones.')->group(function () {
        Route::get('/crear', [DevolucionController::class, 'create'])->name('create');
        Route::post('/', [DevolucionController::class, 'store'])->name('store');
    });
});

// Rutas de equipos
Route::prefix('equipos')->name('equipos.')->group(function () {
    Route::get('/inventario', [EquipoController::class, 'inventario'])->name('inventario');
    Route::get('/crear', [EquipoController::class, 'create'])->name('create');
    Route::post('/', [EquipoController::class, 'store'])->name('store');

    // Rutas para ver y editar equipos
    Route::get('/{equipo}', [EquipoController::class, 'show'])->name('show');
    Route::get('/{equipo}/editar', [EquipoController::class, 'edit'])->name('edit');
    Route::delete('/{equipo}', [EquipoController::class, 'destroy'])->name('destroy');
});

// Rutas de asignaciones
Route::middleware(['auth','role:admin|admin1|admin2'])->group(function () {
    Route::get('/entregas/crear', [AsignacionController::class, 'create'])->name('entregas.create');
    Route::post('/entregas', [AsignacionController::class, 'store'])->name('entregas.store');
    Route::get('/entregas/{id}/pdf', [AsignacionController::class, 'pdf'])->name('entregas.pdf');

    Route::get('/equipos/crear', [EquipoController::class, 'create'])->name('equipos.create');
    Route::post('/equipos', [EquipoController::class, 'store'])->name('equipos.store');
});
