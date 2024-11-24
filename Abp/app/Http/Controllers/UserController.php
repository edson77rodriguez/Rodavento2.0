<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
class UserController extends Controller
{
       // Listar todos los usuarios
    public function index()
    {
        $users = User::with('rol')->get(); // Obtener usuarios con sus roles
        return view('admin.users.index', compact('users'));
    }

    // Editar rol de un usuario
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Rol::all(); // Obtener todos los roles disponibles
        return view('admin.users.edit', compact('user', 'roles'));
    }

    // Actualizar rol de un usuario
    public function update(Request $request, $id)
    {
        $request->validate([
            'rol_id' => 'required|exists:rols,id' // Asegúrate de que el nombre de la tabla y el campo sean correctos
        ]);

        $user = User::findOrFail($id);
        $user->rol_id = $request->rol_id; // Asegúrate de que este campo existe en tu modelo User
        $user->save();

        return redirect()->route('users.index')->with('success', 'Rol actualizado correctamente.');
    }

    // Método para crear permisos (ejecutar una vez)
    public function createPermissions()
    {
        Permission::create(['name' => 'ver usuarios']);
        Permission::create(['name' => 'crear usuarios']);
        Permission::create(['name' => 'editar usuarios']);
        Permission::create(['name' => 'eliminar usuarios']);
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = true;
        $user->save();

        return redirect()->route('admin.users.index2')->with('success', 'Usuario aprobado con éxito.');
    }

    // En UserController
public function index2()
{
    // Lógica para mostrar todos los usuarios
    $users = User::all(); // o cualquier lógica necesaria
    $roles = Rol::all(); // Obtener todos los roles disponibles

    return view('admin.users.index2', compact('users','roles'));
}



}
