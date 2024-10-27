<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Direccion;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Rol;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {  $direccions = Direccion::all(); // Cargar todas las direcciones
        $roles = Rol::all(); // Cargar todos los roles

        return view('auth.login', compact('direccions', 'roles')); // Pasar ambas variables a la vista
    }

    protected function authenticated(Request $request, $user)
    {
        // Redirigir según el rol del usuario
        if ($user->rol) {
            switch ($user->rol->nom_rol) {
                case 'Administrador':
                    return redirect()->route('admin.dashboard'); // Cambia a tu ruta de administrador
                case 'Supervisor':
                    return redirect()->route('supervisor.dashboard'); // Cambia a tu ruta de supervisor
                default:
                    return redirect()->route('home'); // Ruta por defecto
            }
        }

        // Si no tiene rol, redirige a la página de acceso no autorizado o a otra ruta
        return redirect('/no-autorizado');
    }
}


