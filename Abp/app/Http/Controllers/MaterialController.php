<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\Estado_equipo;
use App\Models\Material;

class MaterialController extends Controller
{
    public function index()
    {
       
        $materiales = Material::all();
        $equipos = Equipo::all();
        $estados = Estado_equipo::all();

        return view('materiales.index', compact('materiales', 'equipos', 'estados'));
    }
    // Guarda una nueva asignación
    public function store(Request $request)
    {
        $request->validate([
            'codigo_m' => 'required',
            'id_equipo' => 'required|exists:equipos,id',
            'estado_e_id' => 'required|exists:estado_equipos,id',
            'fecha_asignacion' => 'required|date',
            'fecha_mantenimiento' => 'required|date',
            
        ]);

        Asignar_actividades::create([
            'codigo_m' => $request->codigo_m,
            'id_equipo' => $request->id_equipo,
            'estado_e_id' => $request->estado_e_id,
            'fecha_asignacion' => $request->fecha_asignacion,
            'fecha_mantenimiento' => $request->fecha_mantenimiento,
        ]);

        return redirect()->route('materiales.index')->with('success', 'Asignación creada exitosamente');
    }

   

    // Actualiza una asignación existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo_m' => 'required',
            'id_equipo' => 'required|exists:equipos,id',
            'estado_e_id' => 'required|exists:estado_equipos,id',
            'fecha_asignacion' => 'required|date',
            'fecha_mantenimiento' => 'required|date',
        ]);

        $material = Material::findOrFail($id);
        $material->update([
            'codigo_m' => $request->codigo_m,
            'id_equipo' => $request->id_equipo,
            'estado_e_id' => $request->estado_e_id,
            'fecha_asignacion' => $request->fecha_asignacion,
            'fecha_mantenimiento' => $request->fecha_mantenimiento,
        ]);

        return redirect()->route('materiales.index')->with('success', 'Asignación actualizada exitosamente');
    }

    // Elimina una asignación
    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();

        return redirect()->route('materiales.index')->with('success', 'Asignación eliminada exitosamente');
    }
}
