<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\Admin\DevolucionController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Editor\DevolucionController as EditorDevolucionController;

/*
|--------------------------------------------------------------------------
| Web Routes - VERSIÓN FINAL COMPLETA
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
Route::middleware(['auth', 'role:admin'])
    ->get('/admin/dashboard', [AdminController::class,'dashboard'])
    ->name('admin.dashboard');

Route::middleware(['auth', 'role:editor'])
    ->get('/editor/dashboard', function(){ return view('editor.dashboard'); })
    ->name('editor.dashboard');

Route::middleware(['auth', 'role:lector'])
    ->get('/lector/dashboard', function(){ return view('lector.dashboard'); })
    ->name('lector.dashboard');

// Rutas de contenido
Route::middleware(['auth'])->group(function () {
    Route::get('/contenido', [\App\Http\Controllers\ContenidoController::class, 'index'])->middleware('permission:ver');
    Route::get('/contenido/crear', [\App\Http\Controllers\ContenidoController::class, 'create'])->middleware('permission:crear');
    Route::post('/contenido', [\App\Http\Controllers\ContenidoController::class, 'store'])->middleware('permission:crear');
    Route::get('/contenido/{id}/editar', [\App\Http\Controllers\ContenidoController::class, 'edit'])->middleware('permission:editar');
    Route::delete('/contenido/{id}', [\App\Http\Controllers\ContenidoController::class, 'destroy'])->middleware('permission:eliminar');
});

// Contactos - Sin restricciones para que editor pueda acceder
Route::middleware(['auth'])->group(function () {
    Route::get('/contact', [ContactController::class, 'show'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
});

// Perfil de usuario
Route::middleware(['auth'])->group(function () {
    Route::get('usuario/perfil', [UsuarioController::class, 'editarPerfil'])->name('usuario.perfil');
    Route::put('usuario/perfil', [UsuarioController::class, 'actualizarPerfil'])->name('usuario.actualizarPerfil');
});

// Nuevo perfil (modal)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/update-field', [ProfileController::class, 'updateField'])->name('profile.updateField');
});

// ===========================
// RUTAS DEL ADMINISTRADOR (SIN CAMBIOS)
// ===========================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Roles
    Route::get('/usuario/asignar', [UsuarioController::class, 'asignar'])->name('usuario.asignar');
    Route::post('/usuario/asignar', [UsuarioController::class, 'asignarRol'])->name('usuario.asignar.store');

    // CRUD
    Route::get('/crear', [AdminController::class, 'create'])->name('crear');
    Route::post('/guardar', [AdminController::class, 'store'])->name('guardar');
    Route::get('/editar/{id}', [AdminController::class, 'edit'])->name('editar');
    Route::put('/actualizar/{id}', [AdminController::class, 'update'])->name('actualizar');
    Route::delete('/eliminar/{id}', [AdminController::class, 'destroy'])->name('eliminar');

    // Devoluciones del admin
    Route::prefix('devoluciones')->name('devoluciones.')->group(function () {
        Route::get('/crear', [DevolucionController::class, 'create'])->name('create');
        Route::post('/', [DevolucionController::class, 'store'])->name('store');
    });
});

// ===========================
// RUTAS DE EQUIPOS (MANTENIENDO TU LÓGICA ORIGINAL)
// ===========================
Route::prefix('equipos')->name('equipos.')->group(function () {
    // Inventario - todos pueden ver
    Route::get('/inventario', [EquipoController::class, 'inventario'])
        ->middleware(['auth'])
        ->name('inventario');
    
    // Crear equipos - solo admin
    Route::get('/crear', [EquipoController::class, 'create'])
        ->middleware(['auth', 'role:admin'])
        ->name('create');
    
    Route::post('/', [EquipoController::class, 'store'])
        ->middleware(['auth', 'role:admin'])
        ->name('store');

    // Ver detalle - todos pueden
    Route::get('/{equipo}', [EquipoController::class, 'show'])
        ->middleware(['auth'])
        ->name('show');
    
    // Editar - admin y editor pueden editar
    Route::get('/{equipo}/editar', [EquipoController::class, 'edit'])
        ->middleware(['auth', 'role:admin|editor'])
        ->name('edit');
    
    Route::put('/{equipo}', [EquipoController::class, 'update'])
        ->middleware(['auth', 'role:admin|editor'])
        ->name('update');

    // Eliminar - solo admin (mantengo tu middleware original)
    Route::delete('/{equipo}', [EquipoController::class, 'destroy'])
        ->name('destroy')
        ->middleware(['auth','permission:eliminar equipos']);
});

// ===========================
// RUTAS DE ASIGNACIONES/ENTREGAS
// ===========================

// Admin puede crear entregas
Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/entregas/crear', [AsignacionController::class, 'create'])->name('entregas.create');
    Route::post('/entregas', [AsignacionController::class, 'store'])->name('entregas.store');
    Route::get('/entregas/{id}/pdf', [AsignacionController::class, 'pdf'])->name('entregas.pdf');
});

// Editor también puede crear entregas
Route::middleware(['auth','role:editor'])->prefix('editor')->name('editor.')->group(function () {
    Route::get('/entregas/crear', [AsignacionController::class, 'create'])->name('entregas.create');
    Route::post('/entregas', [AsignacionController::class, 'store'])->name('entregas.store');
    Route::get('/entregas/{id}/pdf', [AsignacionController::class, 'pdf'])->name('entregas.pdf');
    
    // Ruta para documentos
    Route::get('/documentos', function() {
        return view('editor.documentos.index');
    })->name('documentos.index');
});

// ===========================
// RUTAS DE DEVOLUCIONES DEL EDITOR
// ===========================
Route::middleware(['auth','role:editor'])->prefix('editor')->name('editor.')->group(function () {
    Route::get('/devoluciones/crear', [EditorDevolucionController::class, 'create'])
        ->name('devoluciones.create');

    Route::post('/devoluciones', [EditorDevolucionController::class, 'store'])
        ->name('devoluciones.store');
});

// ===========================
// HISTORIAL (USANDO TU MIDDLEWARE EXACTO)
// ===========================
Route::middleware(['auth'])->group(function () {
    // El middleware can:ver-historial está en tu HistorialController
    Route::get('/historial', [HistorialController::class, 'index'])->name('historial.index');
    
    // Solo admin puede eliminar del historial
    Route::delete('/historial/{id}', [HistorialController::class, 'destroy'])
        ->middleware(['role:admin'])
        ->name('historial.destroy');
});

// ===========================
// VISTAS AUXILIARES (SIN CAMBIOS)
// ===========================
Route::middleware(['auth'])->group(function () {
    Route::get('/asignaciones/vista2/{asignacion}', [AsignacionController::class, 'vista2'])->name('asignaciones.vista2');
    Route::post('/asignaciones/vista2', [AsignacionController::class, 'guardarDetalles'])->name('asignaciones.guardarDetalles');
});