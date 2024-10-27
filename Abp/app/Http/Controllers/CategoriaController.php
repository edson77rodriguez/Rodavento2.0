<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria; 
class CategoriaController extends Controller
{
    public function index()
    {
        $categorias =Categoria::all();
        return view('admin.cruds.categorias.index', compact('categorias'));
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'desc_cat' => 'required',
        ]);
    
        Categoria::create($validatedData);
    
        return redirect()->route('categorias.index')->with('register',' ');
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
            'desc_cat' => 'required',
        ]);
        $categoria = Categoria::find($id);
        $categoria->update($request->all());

        return redirect()->route('categorias.index')->with('modify',' ');
    }
    public function destroy(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('categorias.index')->with('destroy',' ');
    }
}
