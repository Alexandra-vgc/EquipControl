<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirige la raíz a login
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

// POST login con usuarios reales en base de datos
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    $user = User::where('email', $credentials['email'])->first();

    if ($user && Hash::check($credentials['password'], $user->password)) {
        session(['usuario' => [
            'id' => $user->id,
            'email' => $user->email,
            'rol' => $user->rol ?? 'usuario',
        ]]);
        return redirect('/dashboard');
    }

    return back()->withErrors(['email' => 'Credenciales incorrectas']);
});

// POST registro real guardando en base de datos
Route::post('/register', function (Request $request) {
    $request->validate([
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    $user = User::create([
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'name' => $request->email,
    ]);

    session(['usuario' => [
        'id' => $user->id,
        'email' => $user->email,
        'rol' => 'usuario',
    ]]);

    return redirect('/dashboard');
});

// Dashboard protegido por sesión
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

// Rutas perfil usuario
Route::get('usuario/perfil', [UsuarioController::class, 'editarPerfil'])->name('usuario.perfil');

Route::post('usuario/perfil', function (Request $request) {
    return redirect()->back()->with('success', 'Datos guardados');
})->name('usuario.perfil.guardar');

// Rutas para formulario de contacto
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
