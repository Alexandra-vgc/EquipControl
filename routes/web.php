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
use App\Http\Controllers\DevolucionController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Ruta raíz redirige al login
Route::get('/', function () {
     return redirect()->route('login');
});

// Rutas de autenticación Laravel (login, registro, logout)
Auth::routes(['register' => true]);

// Ruta POST para cerrar sesión (logout)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Redirección por rol después del login
Route::get('/redireccionar-por-rol', function () {
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
})->middleware(['auth']);

// Dashboards protegidos
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::middleware(['auth', 'role:editor'])->get('/editor/dashboard', function () {
    return view('editor.dashboard');
})->name('editor.dashboard');

Route::middleware(['auth', 'role:lector'])->get('/lector/dashboard', function () {
    return view('lector.dashboard');
})->name('lector.dashboard');

// Rutas con permisos para contenido
Route::middleware(['auth'])->group(function () {
    Route::get('/contenido', [\App\Http\Controllers\ContenidoController::class, 'index'])->middleware('permission:ver');
    Route::get('/contenido/crear', [\App\Http\Controllers\ContenidoController::class, 'create'])->middleware('permission:crear');
    Route::post('/contenido', [\App\Http\Controllers\ContenidoController::class, 'store'])->middleware('permission:crear');
    Route::get('/contenido/{id}/editar', [\App\Http\Controllers\ContenidoController::class, 'edit'])->middleware('permission:editar');
    Route::delete('/contenido/{id}', [\App\Http\Controllers\ContenidoController::class, 'destroy'])->middleware('permission:eliminar');
});

// --- AÑADIDO: RUTAS DEL MÓDULO CONTACT ---

Route::middleware(['auth'])->group(function () {
    Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'show'])->name('contact.index');
    Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');
});


Route::middleware(['auth'])->group(function () {
    Route::get('usuario/perfil', [\App\Http\Controllers\UsuarioController::class, 'editarPerfil'])->name('usuario.perfil');

    Route::post('usuario/perfil', function (Illuminate\Http\Request $request) {
        return redirect()->back()->with('success', 'Datos guardados');
    })->name('usuario.perfil.guardar');
    
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
     // 👇 NUEVAS RUTAS para asignar roles a usuarios
    Route::get('/usuario/asignar', [UsuarioController::class, 'asignar'])->name('usuario.asignar');
    Route::post('/usuario/asignar', [UsuarioController::class, 'asignarRol'])->name('usuario.asignar.store');

    
   Route::get('/usuario/asignar', [UsuarioController::class, 'asignar'])->name('usuario.asignar');

    Route::get('/crear', [AdminController::class, 'create'])->name('crear');
    Route::post('/guardar', [AdminController::class, 'store'])->name('guardar');

    Route::get('/editar/{id}', [AdminController::class, 'edit'])->name('editar');
    Route::put('/actualizar/{id}', [AdminController::class, 'update'])->name('actualizar');

    Route::delete('/eliminar/{id}', [AdminController::class, 'destroy'])->name('eliminar');

     Route::prefix('solicitudes')->name('solicitudes.')->group(function () {
    Route::get('/', [SolicitudEntregaController::class, 'index'])->name('index');
    Route::get('/crear', [SolicitudEntregaController::class, 'create'])->name('create');
    Route::post('/', [SolicitudEntregaController::class, 'store'])->name('store');
    Route::get('/{id}/editar', [SolicitudEntregaController::class, 'edit'])->name('edit');
    Route::put('/{id}', [SolicitudEntregaController::class, 'update'])->name('update');
    Route::delete('/{id}', [SolicitudEntregaController::class, 'destroy'])->name('destroy');
    });
});

Route::prefix('equipos')->name('equipos.')->group(function () {
    Route::get('/cpu', [EquipoController::class, 'cpu'])->name('cpu');
    Route::get('/monitor', [EquipoController::class, 'monitor'])->name('monitor');
    Route::get('/teclado', [EquipoController::class, 'teclado'])->name('teclado');
    Route::get('/mouse', [EquipoController::class, 'mouse'])->name('mouse');
});

Route::middleware(['auth','role:admin|admin1|admin2'])->group(function () {
    Route::get('/entregas/crear', [AsignacionController::class, 'create'])->name('entregas.create');
    Route::post('/entregas', [AsignacionController::class, 'store'])->name('entregas.store');
   Route::get('/entregas/{id}/pdf', [AsignacionController::class, 'pdf'])->name('entregas.pdf');

    Route::get('/equipos/crear', [EquipoController::class, 'create'])->name('equipos.create');
    Route::post('/equipos', [EquipoController::class, 'store'])->name('equipos.store');
});
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // otras rutas admin...

    Route::resource('devoluciones', DevolucionController::class);
});



