<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
class RolController extends Controller
{
    public function index()
    {
        $roles =Role::all();
        return view('roles.index', compact('roles'));
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'rol' => 'required',
        ]);
    
        Role::create($validatedData);
    
        return redirect()->route('roles.index')->with('register',' ');
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
            'rol' => 'required',
        ]);
        $rol = Role::find($id);
        $rol->update($request->all());

        return redirect()->route('roles.index')->with('modify',' ');
    }
    public function destroy(string $id)
    {
        $rol = Role::findOrFail($id);
        $rol->delete();

        return redirect()->route('roles.index')->with('destroy',' ');
    }
}
