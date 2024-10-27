<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    // Listar todos los roles
    public function index()
    {
        $roles = Rol::all();
        return view('admin.roles.index', compact('roles'));
    }

    // Crear un nuevo rol
    public function create()
    {
        return view('admin.roles.create');
    }

    // Guardar un nuevo rol
    public function store(Request $request)
    {
        $request->validate([
            'nom_rol' => 'required|unique:rols|max:255',
        ]);

        Rol::create($request->all());
        return redirect()->route('roles.index')->with('success', 'Rol creado correctamente.');
    }

    // Editar un rol existente
    public function edit($id)
    {
        $rol = Rol::findOrFail($id);
        return view('admin.roles.edit', compact('rol'));
    }

    // Actualizar un rol existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_rol' => 'required|unique:rols,nom_rol,' . $id . '|max:255',
        ]);

        $rol = Rol::findOrFail($id);
        $rol->update($request->all());
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
