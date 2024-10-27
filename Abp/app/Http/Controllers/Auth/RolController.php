<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use Illuminate\Http\Request;

// Asegúrate de importar el modelo Rol

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los roles
        $roles = Rol::all();

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create'); // Retornar la vista del formulario para crear un nuevo rol
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'nom_rol' => 'required|string|max:255', // Asegúrate de ajustar las reglas de validación según tus necesidades
        ]);

        // Crear un nuevo rol
        Rol::create([
            'nom_rol' => $request->nom_rol,
        ]);

        return redirect()->route('roles.index')->with('success', 'Rol creado correctamente.'); // Redirigir con un mensaje de éxito
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rol = Rol::findOrFail($id); // Obtener el rol por ID
        return view('roles.show', compact('rol')); // Retornar la vista del rol
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rol = Rol::findOrFail($id); // Obtener el rol por ID
        return view('roles.edit', compact('rol')); // Retornar la vista del formulario para editar el rol
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar la solicitud
        $request->validate([
            'nom_rol' => 'required|string|max:255',
        ]);

        // Encontrar y actualizar el rol
        $rol = Rol::findOrFail($id);
        $rol->update([
            'nom_rol' => $request->nom_rol,
        ]);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente.'); // Redirigir con un mensaje de éxito
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rol = Rol::findOrFail($id); // Obtener el rol por ID
        $rol->delete(); // Eliminar el rol

        return redirect()->route('roles.index')->with('success', 'Rol eliminado correctamente.'); // Redirigir con un mensaje de éxito
    }
}
