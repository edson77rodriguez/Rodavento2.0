<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado_actividad;
class Estado_actividadController extends Controller
{
    public function index()
    {
        $e_actividades =Estado_actividad::all();
        return view('admin.cruds.estado_actividades.index', compact('e_actividades'));
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'desc_estado_a' => 'required',
        ]);
    
        Estado_actividad::create($validatedData);
    
        return redirect()->route('e_actividades.index')->with('register',' ');
    }
    
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'desc_estado_a' => 'required',
        ]);
        $e_actividad = Estado_actividad::find($id);
        $e_actividad->update($request->all());

        return redirect()->route('e_actividades.index')->with('modify',' ');
    }
    public function destroy(string $id)
    {
        $e_actividad = Estado_actividad::findOrFail($id);
        $e_actividad->delete();

        return redirect()->route('e_actividades.index')->with('destroy',' ');
    }
}
