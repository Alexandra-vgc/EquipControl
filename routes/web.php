<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
    Route::get('/contact/create', [\App\Http\Controllers\ContactController::class, 'create'])->name('contact.create');
    Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');
    Route::get('/contact/{id}/edit', [\App\Http\Controllers\ContactController::class, 'edit'])->name('contact.edit');
    Route::put('/contact/{id}', [\App\Http\Controllers\ContactController::class, 'update'])->name('contact.update');
    Route::delete('/contact/{id}', [\App\Http\Controllers\ContactController::class, 'destroy'])->name('contact.destroy');
});
