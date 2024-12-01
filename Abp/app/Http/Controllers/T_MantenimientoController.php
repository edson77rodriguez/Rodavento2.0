<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\T_Mantenimiento;
use App\Models\User;
class T_MantenimientoController extends Controller
{
    public function index()
    {
        $t__mantenimientos =T_Mantenimiento::all();
        $user = auth()->user();
        return view('admin.cruds.t_mantenimientos.index', compact('t__mantenimientos','user'));
    }
    public function create()
    {
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nom_tipo' => 'required',
            'desc_m'=>'required',

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
            'desc_m'=>'required',
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
