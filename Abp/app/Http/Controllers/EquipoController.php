<?php
namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Categoria; 
use Illuminate\Http\Request;

class EquipoController extends Controller
{
 
    public function index()
    {
        $equipos = Equipo::all(); 
        $categorias = Categoria::all(); 
        return view('admin.cruds.equipos.index', compact('equipos', 'categorias'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_equipo' => 'required|string|max:100',
            'categoria_id' => 'required|exists:categorias,id',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer|min:0',
        ]);

        Equipo::create($validatedData);
        return redirect()->route('equipos.index')->with('register',' ');

    }

    public function show($id)
    {
        $equipo = Equipo::findOrFail($id);
        return view('equipos.show', compact('equipo'));
    }

    public function edit($id)
    {
        $equipo = Equipo::findOrFail($id);
        $categorias = Categoria::all();
        return view('equipos.edit', compact('equipo', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nom_equipo' => 'required|string|max:100',
            'categoria_id' => 'required|exists:categorias,id',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer|min:0',
        ]);
        
        $equipo = Equipo::findOrFail($id);
        $equipo->update($validatedData);
        
        return redirect()->route('equipos.index')->with('modify',' ');
    }

    public function destroy($id)
    {
        $equipo = Equipo::findOrFail($id);
        $equipo->delete();
        return redirect()->route('equipos.index')->with('destroy',' ');
    }
}
