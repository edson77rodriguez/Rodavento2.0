<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direccion; 
class DireccionController extends Controller
{
    public function index()
    {
        $direcciones =Direccion::all();
        return view('admin.cruds.direcciones.index', compact('direcciones'));
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'desc_direccion' => 'required',
        ]);
    
        Direccion::create($validatedData);
    
        return redirect()->route('direcciones.index')->with('register',' ');
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
            'desc_direccion' => 'required',
        ]);
        $direccion = Direccion::find($id);
        $direccion->update($request->all());

        return redirect()->route('direcciones.index')->with('modify',' ');
    }
    public function destroy(string $id)
    {
        $direccion = Direccion::findOrFail($id);
        $direccion->delete();

        return redirect()->route('direcciones.index')->with('destroy',' ');
    }
}
