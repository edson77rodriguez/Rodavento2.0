<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; // Importar Auth para obtener al usuario autenticado
use Illuminate\Support\Str; // Importar Str para generar códigos únicos

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nom' => ['required', 'string', 'max:255'],
            'ap' => ['required', 'string', 'max:255'],
            'am' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono' => ['required', 'string', 'max:20'],
            'fecha_nac' => ['required', 'date'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'rol_id' => ['required', 'integer', 'exists:roles,id'],
        ]);
    }

    /**
     * Genera un código de usuario único.
     *
     * @return string
     */
    protected function generateCodigoUsuario()
    {
        $codigo = 'USER-' . Str::random(8); 

        
        while (User::where('codigo_usuario', $codigo)->exists()) {
            $codigo = 'USER-' . Str::random(8); // Regenerar si ya existe
        }

        return $codigo;
    }

    protected function create(array $data)
    {
        return User::create([
            'nom' => $data['nom'],
            'ap' => $data['ap'],
            'am' => $data['am'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'fecha_nac' => $data['fecha_nac'],
            'codigo_usuario' => $this->generateCodigoUsuario(), // Código único generado automáticamente
            'password' => Hash::make($data['password']),
            'rol_id' => $data['rol_id'],
        ]);
    }

    protected function redirectPath()
    {
        $user = Auth::user();

        if ($user->rol_id == 1) {
            return '/dashboard';
        }

        return '/home';
    }
}