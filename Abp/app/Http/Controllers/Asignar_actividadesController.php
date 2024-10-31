<?php

namespace App\Http\Controllers;

use App\Models\Asignar_actividades;
use App\Models\Guia;
use App\Models\Supervisor;
use App\Models\Encargado;
use App\Models\Actividad;
use App\Models\Estado_actividad;
use Illuminate\Http\Request;

class Asignar_actividadesController extends Controller
{
    // Muestra la lista de asignaciones de actividades
    public function index()
    {
        $asignaciones=Asignar_actividades::all();
        $guias = Guia::all();
        $supervisores = Supervisor::all();
        $encargados = Encargado::all();
        $actividades = Actividad::all();
        $estados = Estado_actividad::all();

        return view('asignar_actividades.index', compact('asignaciones', 'guias', 'supervisores', 'encargados', 'actividades', 'estados'));
    }

    // Guarda una nueva asignación
    public function store(Request $request)
    {
        $request->validate([
            'guia_id' => 'required|exists:guias,id',
            'supervisor_id' => 'required|exists:supervisors,id',
            'encargado_id' => 'required|exists:encargados,id',
            'actividad_id' => 'required|exists:actividads,id',
            'fecha_asignada' => 'required|date',
            'estado_a_id' => 'required|exists:estado_actividads,id',
        ]);

        Asignar_actividades::create([
            'guia_id' => $request->guia_id,
            'supervisor_id' => $request->supervisor_id,
            'encargado_id' => $request->encargado_id,
            'actividad_id' => $request->actividad_id,
            'fecha_asignada' => $request->fecha_asignada,
            'estado_a_id' => $request->estado_a_id,
        ]);

        return redirect()->route('asignar_actividades.index')->with('success', 'Asignación creada exitosamente');
    }

   

    // Actualiza una asignación existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'guia_id' => 'required|exists:guias,id',
            'supervisor_id' => 'required|exists:supervisores,id',
            'encargado_id' => 'required|exists:encargados,id',
            'actividad_id' => 'required|exists:actividades,id',
            'fecha_asignada' => 'required|date',
            'estado_a_id' => 'required|exists:estado_actividades,id',
        ]);

        $asignacion = Asignar_actividades::findOrFail($id);
        $asignacion->update([
            'guia_id' => $request->guia_id,
            'supervisor_id' => $request->supervisor_id,
            'encargado_id' => $request->encargado_id,
            'actividad_id' => $request->actividad_id,
            'fecha_asignada' => $request->fecha_asignada,
            'estado_a_id' => $request->estado_a_id,
        ]);

        return redirect()->route('asignar_actividades.index')->with('success', 'Asignación actualizada exitosamente');
    }

    // Elimina una asignación
    public function destroy($id)
    {
        $asignacion = Asignar_actividades::findOrFail($id);
        $asignacion->delete();

        return redirect()->route('asignar_actividades.index')->with('success', 'Asignación eliminada exitosamente');
    }
}
