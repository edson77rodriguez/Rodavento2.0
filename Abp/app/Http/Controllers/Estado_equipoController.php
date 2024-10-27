<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado_equipo;
class Estado_equipoController extends Controller
{
    public function index()
    {
        $e_equipos =Estado_equipo::all();
        return view('admin.cruds.estado_equipos.index', compact('e_equipos'));
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'desc_estado_e' => 'required',
        ]);
    
        Estado_equipo::create($validatedData);
    
        return redirect()->route('e_equipos.index')->with('register',' ');
    }
    
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'desc_estado_e' => 'required',
        ]);
        $e_equipo = Estado_equipo::find($id);
        $e_equipo->update($request->all());

        return redirect()->route('e_equipos.index')->with('modify',' ');
    }
    public function destroy(string $id)
    {
        $e_equipo = Estado_equipo::findOrFail($id);
        $e_equipo->delete();

        return redirect()->route('e_equipos.index')->with('destroy',' ');
    }
}
