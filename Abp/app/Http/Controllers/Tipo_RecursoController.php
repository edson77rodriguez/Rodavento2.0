<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipo_recurso;
class Tipo_RecursoController extends Controller
{
    public function index()
    {
        $tipos =Tipo_recurso::all();
        return view('tipos.index', compact('tipos'));
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_resurso' => 'required',
        ]);
    
        Tipo_recurso::create($validatedData);
    
        return redirect()->route('tipos.index')->with('register',' ');
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
       
    }
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nom_resurso' => 'required',
        ]);
        $tipo = Tipo_recurso::find($id);
        $tipo->update($request->all());

        return redirect()->route('tipos.index')->with('modify',' ');
    }
    public function destroy(string $id)
    {
        $tipo = Tipo_recurso::findOrFail($id);
        $tipo->delete();

        return redirect()->route('tipos.index')->with('destroy',' ');
    }
}
