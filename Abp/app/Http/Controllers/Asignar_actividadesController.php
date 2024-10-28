<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Asignar_actividades;
use App\Models\User;
use App\Models\Actividad;
use App\Models\Estado_actividad;

class Asignar_actividadesController extends Controller
{
    public function index()
    {
        // Obtener todas las asignaciones de actividades junto con sus relaciones
        $asignaciones = Asignar_actividades::with(['guia', 'supervisor', 'encargado', 'actividad', 'estado'])->get();
        
        // Filtrar usuarios por rol
        $guias = User::where('rol_id', 3)->get(); // ID para guías
        $supervisores = User::where('rol_id', 4)->get(); // ID para supervisores
        $encargados = User::where('rol_id', 2)->get(); // ID para encargados
        
        $actividades = Actividad::all();
        $estados = Estado_actividad::all(); // Para el formulario de creación y edición

        return view('asignar_actividades.index', compact('asignaciones', 'guias', 'supervisores', 'encargados', 'actividades', 'estados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guia_id' => 'required|exists:users,id',
            'supervisor_id' => 'required|exists:users,id',
            'encargado_id' => 'required|exists:users,id',
            'actividad_id' => 'required|exists:actividads,id',
            'fecha_asignada' => 'required|date',
            'estado_a_id' => 'required|exists:estado_actividads,id',
        ]);

        Asignar_actividades::create($request->all());
        return redirect()->route('asignar_actividades.index')->with('register', 'Actividad asignada exitosamente.');
    }

    public function update(Request $request, Asignar_actividades $asignarActividad)
    {
        $request->validate([
            'guia_id' => 'required|exists:users,id',
            'supervisor_id' => 'required|exists:users,id',
            'encargado_id' => 'required|exists:users,id',
            'actividad_id' => 'required|exists:actividads,id',
            'fecha_asignada' => 'required|date',
            'estado_a_id' => 'required|exists:estado_actividads,id',
        ]);

        $asignarActividad->update($request->all());
        return redirect()->route('asignar_actividades.index')->with('modify', 'Asignación actualizada exitosamente.');
    }

    public function destroy(Asignar_actividades $asignarActividad)
    {
        $asignarActividad->delete();
        return redirect()->route('asignar_actividades.index')->with('destroy', 'Asignación eliminada exitosamente.');
    }
}
