<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habilidad;
use App\Models\T_habilidad;
class HabilidadController extends Controller
{
    // Método para mostrar la vista con las habilidades
    public function index()
    {
        $t_habilidades = T_habilidad::all(); // Obtener todos los tipos de habilidades
        $habilidades = Habilidad::all(); // Obtener todas las habilidades
        return view('admin.cruds.habilidades.index', compact('t_habilidades', 'habilidades'));
    }

    // Método para almacenar una nueva habilidad
    public function store(Request $request)
    {
        $request->validate([
            'nom_hab' => 'required',
            'desc_habilidad' => 'required',
            't_habilidad_id' => 'required|exists:t_habilidades,id',
        ]);

        Habilidad::create($request->all());
        return redirect()->route('habilidades.index')->with('register', 'Habilidad creada exitosamente.');
    }

    // Método para mostrar los detalles de una habilidad
    public function show($id)
    {
        $habilidad = Habilidad::findOrFail($id);
        return response()->json($habilidad);
    }

    // Método para actualizar una habilidad
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_hab' => 'required',
            'desc_habilidad' => 'required',
            't_habilidad_id' => 'required|exists:t_habilidades,id',
        ]);

        $habilidad = Habilidad::findOrFail($id);
        $habilidad->update($request->all());
        return redirect()->route('habilidades.index')->with('modify', 'Habilidad actualizada exitosamente.');
    }

    // Método para eliminar una habilidad
    public function destroy($id)
    {
        $habilidad = Habilidad::findOrFail($id);
        $habilidad->delete();
        return redirect()->route('habilidades.index')->with('destroy', 'Habilidad eliminada exitosamente.');
    }
}
