<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UsuarioController;


Route::get('/', function () {
    return redirect('/login');
});

// Vista de login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Vista de registro
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// POST login con usuarios quemados
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    $usuariosQuemados = [
        ['email' => 'admin@intesud.edu.ec', 'password' => 'admin123', 'rol' => 'admin'],
        ['email' => 'usuario@intesud.edu.ec', 'password' => 'user123', 'rol' => 'usuario'],
    ];

    foreach ($usuariosQuemados as $usuario) {
        if (
            $credentials['email'] === $usuario['email'] &&
            $credentials['password'] === $usuario['password']
        ) {
            session(['usuario' => $usuario]);
            return redirect('/dashboard');
        }
    }

    return back()->withErrors(['email' => 'Credenciales incorrectas']);
});

// POST registro (solo simulado, no guarda en DB)
Route::post('/register', function (Request $request) {
    $datos = $request->only('email', 'password');

    session(['usuario' => [
        'email' => $datos['email'],
        'password' => $datos['password'],
        'rol' => 'nuevo'
    ]]);

    return redirect('/dashboard');
});

// Dashboard (protegido por sesión)
Route::get('/dashboard', function () {
    if (!session()->has('usuario')) {
        return redirect('/login');
    }

    $usuario = session('usuario');
    return view('dashboard', compact('usuario'));
});

// Cerrar sesión
Route::get('/logout', function () {
    session()->forget('usuario');
    return redirect('/login');
});

Route::get('usuario/perfil', [App\Http\Controllers\UsuarioController::class, 'editarPerfil'])->name('usuario.perfil');
Route::post('usuario/perfil', function (Request $request) {
    return redirect()->back()->with('success', 'Datos guardados');
})->name('usuario.perfil.guardar');
