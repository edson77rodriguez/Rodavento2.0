<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area; 
class AreaController extends Controller
{
    public function index()
    {
        $areas =Area::all();
        return view('admin.cruds.areas.index', compact('areas'));
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'desc_area' => 'required',
        ]);
    
        Area::create($validatedData);
    
        return redirect()->route('areas.index')->with('register',' ');
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
            'desc_area' => 'required',
        ]);
        $area = Area::find($id);
        $area->update($request->all());

        return redirect()->route('areas.index')->with('modify',' ');
    }
    public function destroy(string $id)
    {
        $area = Area::findOrFail($id);
        $area->delete();

        return redirect()->route('areas.index')->with('destroy',' ');
    }
}
