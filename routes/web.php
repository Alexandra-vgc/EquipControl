<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UsuarioController;
<<<<<<< HEAD

=======
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
>>>>>>> 9f3eb7a (formulario contactos base de datos cambios de Vanessa)

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

<<<<<<< HEAD
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
=======
// POST login con usuarios reales de la base de datos
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    $user = User::where('email', $credentials['email'])->first();

    if ($user && Hash::check($credentials['password'], $user->password)) {
        session(['usuario' => [
            'id' => $user->id,
            'email' => $user->email,
            'rol' => $user->rol ?? 'usuario', // si no hay rol, pone 'usuario'
        ]]);
        return redirect('/dashboard');
>>>>>>> 9f3eb7a (formulario contactos base de datos cambios de Vanessa)
    }

    return back()->withErrors(['email' => 'Credenciales incorrectas']);
});

<<<<<<< HEAD
// POST registro (solo simulado, no guarda en DB)
Route::post('/register', function (Request $request) {
    $datos = $request->only('email', 'password');

    session(['usuario' => [
        'email' => $datos['email'],
        'password' => $datos['password'],
        'rol' => 'nuevo'
=======
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
>>>>>>> 9f3eb7a (formulario contactos base de datos cambios de Vanessa)
    ]]);

    return redirect('/dashboard');
});

<<<<<<< HEAD
// Dashboard (protegido por sesión)
=======
// Dashboard protegido por sesión
>>>>>>> 9f3eb7a (formulario contactos base de datos cambios de Vanessa)
Route::get('/dashboard', function () {
    if (!session()->has('usuario')) {
        return redirect('/login');
    }
<<<<<<< HEAD

=======
>>>>>>> 9f3eb7a (formulario contactos base de datos cambios de Vanessa)
    $usuario = session('usuario');
    return view('dashboard', compact('usuario'));
});

// Cerrar sesión
Route::get('/logout', function () {
    session()->forget('usuario');
    return redirect('/login');
});

<<<<<<< HEAD
Route::get('usuario/perfil', [App\Http\Controllers\UsuarioController::class, 'editarPerfil'])->name('usuario.perfil');
Route::post('usuario/perfil', function (Request $request) {
    return redirect()->back()->with('success', 'Datos guardados');
})->name('usuario.perfil.guardar');
=======
// Rutas perfil usuario
Route::get('usuario/perfil', [UsuarioController::class, 'editarPerfil'])->name('usuario.perfil');
Route::post('usuario/perfil', function (Request $request) {
    return redirect()->back()->with('success', 'Datos guardados');
})->name('usuario.perfil.guardar');

// Formulario de
>>>>>>> 9f3eb7a (formulario contactos base de datos cambios de Vanessa)
