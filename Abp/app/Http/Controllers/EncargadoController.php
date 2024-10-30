<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Area;
use App\Models\Encargado;
use Illuminate\Http\Request;

class EncargadoController extends Controller
{
    public function index()
    {
        // Filtrar solo los usuarios con rol de 'encargado'
        $users = User::with('rol')->whereHas('rol', function($query) {
            $query->where('nom_rol', 'encargado'); // Asegúrate de que 'encargado' es el nombre correcto del rol
        })->get();
    
        // Obtener todas las áreas
        $areas = Area::all();
    
        // Pasar solo los encargados y áreas a la vista
        return view('encargados.index', compact('users', 'areas'));
    }
    

    public function asignarArea(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        // Verificar que el usuario tiene el rol de encargado
        if ($user->rol->nom_rol !== 'Encargado') {
            return redirect()->back()->with('error', 'El usuario no es un encargado.');
        }

        // Crear o actualizar el registro de encargado
        Encargado::updateOrCreate(
            ['user_id' => $user->id],
            ['area_id' => $request->area_id]
        );

        return redirect()->back()->with('success', 'Área asignada correctamente.');
    }
    public function asignarVista($userId)
    {
        $user = User::with('rol')->findOrFail($userId);
        $areas = Area::all();
    
        return view('encargados.asignar', compact('user', 'areas'));
    }
    
    public function showAsignarArea($userId)
{
    // Busca el usuario por ID, incluyendo su rol
    $user = User::with('rol')->findOrFail($userId);
    // Obtiene todas las áreas
    $areas = Area::all();

    // Retorna la vista con el usuario y las áreas
    return view('encargados.asignar', compact('user', 'areas'));
}

}
