<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Direccion;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Rol;
use App\Models\Guia; 
class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        $direccions = Direccion::all(); // Cargar todas las direcciones
        $roles = Rol::all(); // Cargar todos los roles

        return view('auth.login', compact('direccions', 'roles')); // Pasar ambas variables a la vista
    }

    protected function authenticated(Request $request, $user)
    {
        // Verificar si el rol del usuario es "Guía" (ID = 3 o nombre del rol es "Guía")
        if ($user->rol && ($user->rol->id == 3 || $user->rol->nom_rol == 'Guía')) {
            // Verificar si el usuario ya está en la tabla guias
            if (!Guia::where('user_id', $user->id)->exists()) {
                // Crear una nueva entrada en la tabla guias
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
                    return redirect()->route('supervisor.dashboard');
                default:
                    return redirect()->route('home');
            }
        }

        // Redirección si no tiene rol asignado
        return redirect('/no-autorizado');
    }
}


