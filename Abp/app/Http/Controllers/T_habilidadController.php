<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\T_habilidad;
class T_habilidadController extends Controller
{
    public function index()
    {
        $t_habilidades =T_habilidad::all();
        return view('admin.cruds.T_Habilidades.index', compact('t_habilidades'));
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'desc_t' => 'required',
        ]);
    
        T_habilidad::create($validatedData);
    
        return redirect()->route('t_habilidades.index')->with('register',' ');
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
            'desc_t' => 'required',
        ]);
        $t_habilidad = T_habilidad::find($id);
        $t_habilidad->update($request->all());

        return redirect()->route('t_habilidades.index')->with('modify',' ');
    }
    public function destroy(string $id)
    {
        $t_habilidad = T_habilidad::findOrFail($id);
        $t_habilidad->delete();

        return redirect()->route('t_habilidades.index')->with('destroy',' ');
    }
}
