<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirigir después del login según rol.
     */
    protected function authenticated($request, $user)
    {
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('editor')) {
            return redirect()->route('editor.dashboard');
        }

        if ($user->hasRole('lector')) {
            return redirect()->route('lector.dashboard');
        }

        Auth::logout();
         return redirect()->route('login');

        
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }
}
