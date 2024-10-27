<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;
class EstadoController extends Controller
{
    public function index()
    {
        $estados =Estado::all();
        return view('estados.index', compact('estados'));
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'desc_estado' => 'required',
        ]);
    
        Estado::create($validatedData);
    
        return redirect()->route('estados.index')->with('register',' ');
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
            'desc_estado' => 'required',
        ]);
        $estado = Estado::find($id);
        $estado->update($request->all());

        return redirect()->route('estados.index')->with('modify',' ');
    }
    public function destroy(string $id)
    {
        $estado = Estado::findOrFail($id);
        $estado->delete();

        return redirect()->route('estados.index')->with('destroy',' ');
    }
}
