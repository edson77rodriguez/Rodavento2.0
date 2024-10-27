<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use Illuminate\Http\Request;

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
             'rol_id' => 'required|exists:rols,id'
         ]);
 
         $user = User::findOrFail($id);
         $user->rol_id = $request->rol_id;
         $user->save();
 
         return redirect()->route('users.index')->with('success', 'Rol actualizado correctamente.');
     }
}
