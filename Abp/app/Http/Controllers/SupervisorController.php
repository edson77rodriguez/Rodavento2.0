<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Area;
use App\Models\Supervisor;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function index()
    {
        $users = User::with('rol')->whereHas('rol', function($query) {
            $query->where('nom_rol', 'Supervisor'); 
        })->get();
    
        $areas = Area::all();
    
        return view('supervisores.index', compact('users', 'areas'));
    }
    

    public function asignarArea(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        if ($user->rol->nom_rol !== 'Supervisor') {
            return redirect()->back()->with('error', 'El usuario no es un encargado.');
        }

        Supervisor::updateOrCreate(
            ['user_id' => $user->id],
            ['area_id' => $request->area_id]
        );

        return redirect()->back()->with('success', 'Área asignada correctamente.');
    }
    public function asignarVista($userId)
    {
        $user = User::with('rol')->findOrFail($userId);
        $areas = Area::all();
    
        return view('supervisores.asignar', compact('user', 'areas'));
    }
    
    public function showAsignarArea($userId)
{
    $user = User::with('rol')->findOrFail($userId);
    $areas = Area::all();

    return view('supervisores.asignar', compact('user', 'areas'));
}

}
