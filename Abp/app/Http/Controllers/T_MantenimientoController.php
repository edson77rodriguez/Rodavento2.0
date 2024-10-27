<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\T_Mantenimiento;
class T_MantenimientoController extends Controller
{
    public function index()
    {
        $t_mantenimientos =T_Mantenimiento::all();
        return view('admin.cruds.t_mantenimientos.index', compact('t_mantenimientos'));
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_tipo' => 'required',
            'desc_t'=>'required',
        ]);
    
        T_Mantenimiento::create($validatedData);
    
        return redirect()->route('t_mantenimientos.index')->with('register',' ');
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
            'nom_tipo' => 'required',
            'desc_t'=>'required',
        ]);
        $t_mantenimiento = T_Mantenimiento::find($id);
        $t_mantenimiento->update($request->all());

        return redirect()->route('t_mantenimientos.index')->with('modify',' ');
    }
    public function destroy(string $id)
    {
        $t_mantenimiento = T_Mantenimiento::findOrFail($id);
        $t_mantenimiento->delete();

        return redirect()->route('t_mantenimientos.index')->with('destroy',' ');
    }
}
