<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\Guia;
use App\Models\Asignar_Equipo;
use App\Models\Material;
class Asignar_EquipoController extends Controller
{
    public function index()
    {
        $actividades=Actividad::all();
        $guias = Guia::all();
        $asignaciones = Asignar_Equipo::all();
        $materiales = Material::all();

        return view('asignar_equipos.index', compact('asignaciones', 'guias', 'materiales','actividades'));
    }

     // Guarda una nueva asignación
     public function store(Request $request)
     {
        $validatedData = $request->validate([
             'material_id' => 'required|exists:materials,id',
             'guia_id' => 'required|exists:guias,id',
             'actividad_id' => 'required|exists:actividads,id',
             'fecha_programada' => 'required|date',
             'fecha_devolucion' => 'required|date',
         ]);
 
         Asignar_Equipo::create($validatedData);
 
         return redirect()->route('asignar_equipos.index')->with('success', 'Asignación creada exitosamente');
     }
     public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'material_id' => 'required|exists:materials,id',
             'guia_id' => 'required|exists:guias,id',
             'actividad_id' => 'required|exists:actividads,id',
             'fecha_programada' => 'required|date',
             'fecha_devolucion' => 'required|date',
        ]);

        $asignacion = Asignar_Equipo::find($id);
        $asignacion->update($request->all());

        return redirect()->route('asignar_equipos.index')->with('success', 'Asignación actualizada exitosamente');
    }
     // Elimina una asignación
     public function destroy($id)
     {
         $asignacion = Asignar_Equipo::findOrFail($id);
         $asignacion->delete();
 
         return redirect()->route('asignar_equipos.index')->with('success', 'Asignación eliminada exitosamente');
     }
}
