<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Rol; // Importa el modelo Rol
use App\Models\Direccion; // Importa el modelo Direccion
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Guia;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware(['auth'])->except(['showRegistrationForm', 'register']);
    }

    /**
     * Validar los datos de entrada para el registro del usuario.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nom' => ['required', 'string', 'max:255'],
            'ap' => ['required', 'string', 'max:255'],
            'am' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono' => ['required', 'string', 'max:20'],
            'direccion_id' => ['required', 'exists:direccions,id'], // Validación para el ID de dirección
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'rol_id' => ['required', 'exists:rols,id'], // Validación para el ID del rol
        ]);
    }

    /**
     * Crear un nuevo usuario en la base de datos.
     */
    protected function create(array $data)
    {
        // Crear el usuario usando los datos validados
        return User::create([
            'nom' => $data['nom'],
            'ap' => $data['ap'],
            'am' => $data['am'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'direccion_id' => $data['direccion_id'],
            'rol_id' => $data['rol_id'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Registrar un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nom' => 'required|string|max:191',
            'ap' => 'required|string|max:191',
            'am' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'direccion_id' => 'required|exists:direccions,id',
            'telefono' => 'required|string|max:191',
            'password' => 'required|string|min:8',
            'rol_id' => 'required|exists:rols,id',

        ]);

        // Llamar al procedimiento almacenado (si es necesario)
        DB::statement('CALL InsertUsers(?, ?, ?, ?, ?, ?, ?, ?)', [
            $validated['nom'],
            $validated['ap'],
            $validated['am'],
            $validated['email'],
            $validated['direccion_id'],
            $validated['telefono'],
            Hash::make($validated['password']),
            $validated['rol_id']
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Redirige según el rol del usuario.
     */
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

    /**
     * Mostrar el formulario de registro.
     */
    public function showRegistrationForm()
    {
        $roles = Rol::all(); // Obtiene todos los roles disponibles
        $direccions = Direccion::all(); // Obtiene todas las direcciones disponibles

        return view('auth.register', compact('roles', 'direccions')); // Pasa los roles y direcciones a la vista
    }
    public function register(Request $request)
{
    // Validate the incoming request data
    $validated = $request->validate([
        'nom' => 'required|string|max:191',
        'ap' => 'required|string|max:191',
        'am' => 'required|string|max:191',
        'email' => 'required|string|email|max:191|unique:users',
        'direccion_id' => 'required|exists:direccions,id',
        'telefono' => 'required|string|max:191',
        'password' => 'required|string|min:8',
        'rol_id' => 'required|exists:rols,id',
    ]);

    // Call the procedure stored (if needed)
    DB::statement('CALL InsertUsers(?, ?, ?, ?, ?, ?, ?, ?)', [
        $validated['nom'],
        $validated['ap'],
        $validated['am'],
        $validated['email'],
        $validated['direccion_id'],
        $validated['telefono'],
        Hash::make($validated['password']),
        $validated['rol_id']
    ]);

    // Redirect to the users index page with a success message
    return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
}
}
