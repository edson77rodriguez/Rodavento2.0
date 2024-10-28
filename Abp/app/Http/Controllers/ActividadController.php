<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsignarActividad;
use App\Models\User;
use App\Models\Actividad;
use App\Models\Duracion;
class ActividadController extends Controller
{
    public function index()
    {
        $actividades = Actividad::with('duracion')->get();
        $duraciones = Duracion::all(); // Para el formulario de creación y edición
        return view('actividades.index', compact('actividades', 'duraciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_act' => 'required|string|max:255',
            'duracion_id' => 'required|exists:duracions,id',
        ]);

        Actividad::create($request->all());
        return redirect()->route('actividades.index')->with('register', 'Actividad creada exitosamente.');
    }

    public function update(Request $request, Actividad $actividad)
    {
        $request->validate([
            'nom_act' => 'required|string|max:255',
            'duracion_id' => 'required|exists:duracions,id',
        ]);

        $actividad->update($request->all());
        return redirect()->route('actividades.index')->with('modify', 'Actividad actualizada exitosamente.');
    }

    public function destroy(Actividad $actividad)
    {
        $actividad->delete();
        return redirect()->route('actividades.index')->with('destroy', 'Actividad eliminada exitosamente.');
    }
}
