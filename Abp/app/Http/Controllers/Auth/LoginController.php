<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Direccion;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Rol;
use App\Models\Guia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $direccions = Direccion::all(); // Cargar todas las direcciones
        $roles = Rol::all(); // Cargar todos los roles

        return view('auth.login', compact('direccions', 'roles')); // Pasar ambas variables a la vista
    }


    protected function authenticated(Request $request, $user)
    {
        // Verificar si el usuario está aprobado
        if ($user->rol->nom_rol=='Administrador')
        {
            return redirect()->route('admin.dashboard');

        }
        if (!$user->is_approved) {
            Auth::logout();
            return redirect()->route('awaiting-approval');
        }

        // Verificar si el usuario es "Guía" y crear una entrada en la tabla `Guias` si no existe
        if ($user->rol && ($user->rol->id == 3 || $user->rol->nom_rol == 'Guía')) {
            if (!Guia::where('user_id', $user->id)->exists()) {
                Guia::create([
                    'user_id' => $user->id,
                ]);
            }
        }

        // Redirigir según el rol del usuario
        if ($user->rol) {
            switch ($user->rol->nom_rol) {
                case 'Administrador':
                    return redirect()->route('admin.dashboard');
                case 'Supervisor':
                    return redirect()->route('admin.dashboard');
                case 'Encargado':
                    return redirect()->route('admin.dashboard');
                case 'Guia':
                    return redirect()->route('home');
                default:
                    return redirect()->route('home');
            }
        }

        // Redirección si no tiene rol asignado
        return redirect('/no-autorizado');
    }
}
