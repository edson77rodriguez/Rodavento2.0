<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Duracion;
class DuracionController extends Controller
{
    public function index()
    {
        $duraciones =Duracion::all();
        return view('admin.cruds.duraciones.index', compact('duraciones'));
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'desc_duracion' => 'required',
        ]);
    
        Duracion::create($validatedData);
    
        return redirect()->route('duraciones.index')->with('register',' ');
    }
    
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'desc_duracion' => 'required',
        ]);
        $duracion = Duracion::find($id);
        $duracion->update($request->all());

        return redirect()->route('duraciones.index')->with('modify',' ');
    }
    public function destroy(string $id)
    {
        $duracion = Duracion::findOrFail($id);
        $duracion->delete();

        return redirect()->route('duraciones.index')->with('destroy',' ');
    }
}
