<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rol; // Importa el modelo Rol
use App\Models\Direccion; // Importa el modelo Direccion
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Guia; 

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        // Middleware para usuarios autenticados y aprobados
        $this->middleware(['auth']);
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nom' => ['required', 'string', 'max:255'],
            'ap' => ['required', 'string', 'max:255'],
            'am' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono' => ['required', 'string', 'max:20'],
            'direccion_id' => ['required', 'integer', 'exists:direccions,id'], // Validación para la dirección
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'rol_id' => ['required', 'integer', 'exists:rols,id'], // Validación para la dirección

        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'nom' => $data['nom'],
            'ap' => $data['ap'],
            'am' => $data['am'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'direccion_id' => $data['direccion_id'], // Guarda la dirección
            'password' => Hash::make($data['password']),
            'rol_id' => $data['rol_id'], // Guarda el rol
        ]);
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
    }

    protected function redirectPath()
    {
        $user = Auth::user();

        if ($user->rol_nom == 'Administrador') {
            return '/admin';
        }
        if ($user->rol_nom == 'Supervisor') {
            return '/admin';
        }
        if ($user->rol_nom == 'Encargado') {
            return '/admin';
        }
        if ($user->rol_nom == 'Guia') {
            return '/home';
        }
        return '/home';
    }

    public function showRegistrationForm()
    {
        $roles = Rol::all(); // Obtiene todos los roles disponibles
        $direccions = Direccion::all(); // Obtiene todas las direcciones disponibles

        return view('auth.register', compact('roles', 'direccions')); // Pasa los roles y direcciones a la vista
    }
}
