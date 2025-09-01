<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/login';

    /**
     * Sobrescribimos la respuesta al reset
     */
    protected function sendResetResponse(Request $request, $response)
    {
        return Redirect::to('/login')->with('status', '✅ Tu contraseña ha sido actualizada correctamente.');
    }
}
