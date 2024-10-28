<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use App\Models\Permission; // Asegúrate de incluir este modelo
use Illuminate\Http\Request;

class RolController extends Controller
{
    // Mostrar todos los roles
    public function index()
    {
        $roles = Rol::all(); // Obtener todos los roles
        return view('admin.roles.index', compact('roles')); // Asegúrate de que la vista exista
    }

    // Crear nuevo rol
    public function create()
    {
        $permissions = Permission::all(); // Obtener todos los permisos disponibles
        return view('admin.roles.create', compact('permissions')); // Asegúrate de que la vista exista
    }

    // Almacenar nuevo rol
    public function store(Request $request)
    {
        $request->validate([
            'nom_rol' => 'required|unique:rols|max:255',
            'permissions' => 'array'
        ]);

        $rol = Rol::create(['nom_rol' => $request->nom_rol]);

        // Asignar permisos al rol
        if ($request->permissions) {
            $rol->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Rol creado correctamente.');
    }

    // Editar rol existente
    public function edit($id)
    {
        $rol = Rol::findOrFail($id);
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('rol', 'permissions')); // Asegúrate de que la vista exista
    }

    // Actualizar rol existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_rol' => 'required|unique:rols,nom_rol,' . $id . '|max:255',
            'permissions' => 'array'
        ]);

        $rol = Rol::findOrFail($id);
        $rol->update($request->all());

        // Actualizar permisos del rol
        if ($request->permissions) {
            $rol->syncPermissions($request->permissions);
        } else {
            $rol->syncPermissions([]); // Si no hay permisos, eliminar todos
        }

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente.');
    }

    // Eliminar un rol
    public function destroy($id)
    {
        $rol = Rol::findOrFail($id);
        $rol->delete();

        return redirect()->route('roles.index')->with('success', 'Rol eliminado correctamente.');
    }
}