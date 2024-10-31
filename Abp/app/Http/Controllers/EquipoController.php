<?php
namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Categoria; // Importar el modelo de Categorias
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function index()
    {
        // Obtener todos los equipos con sus categorías asociadas
        $equipos = Equipo::with('categoria')->get();
        // Obtener todas las categorías
        $categorias = Categoria::all(); // Añadir esta línea
        // Pasar ambas variables a la vista
        return view('admin.cruds.equipos.index', compact('equipos', 'categorias'));
    }

    public function create()
    {
        // Obtener las categorías para mostrarlas en el formulario
        $categorias = Categoria::all();
        return view('equipos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nom_equipo' => 'required|string|max:100',
            'id' => 'required|exists:categorias,id',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer|min:0',
        ]);

        // Crear un nuevo equipo
        Equipo::create($validatedData);
        return redirect()->route('equipos.index')->with('success', 'Registro exitoso');

    }

    public function show($id)
    {
        // Mostrar un equipo específico
        $equipo = Equipo::findOrFail($id);
        return view('equipos.show', compact('equipo'));
    }

    public function edit($id)
    {
        // Obtener el equipo a editar y las categorías disponibles
        $equipo = Equipo::findOrFail($id);
        $categorias = Categoria::all();
        return view('equipos.edit', compact('equipo', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nom_equipo' => 'required|string|max:100',
            'id' => 'required|exists:categorias,id',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer|min:0',
        ]);

        // Actualizar el equipo
        $equipo = Equipo::findOrFail($id);
        $equipo->update($validatedData);
        return redirect()->route('equipos.index')->with('success', 'Equipo actualizado correctamente');
    }

    public function destroy($id)
    {
        // Eliminar el equipo
        $equipo = Equipo::findOrFail($id);
        $equipo->delete();
        return redirect()->route('equipos.index')->with('success', 'Equipo eliminado correctamente');
    }
}
