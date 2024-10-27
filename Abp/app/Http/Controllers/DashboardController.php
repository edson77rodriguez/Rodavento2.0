<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        return view('admin.dashboard',compact('user'));
    }
    public function showCrudMenu()
{
    $user = auth()->user(); // Obtén el usuario autenticado
    // Lista de CRUDs (puede ser dinámica dependiendo de tu sistema)
    $cruds = [
        ['name' => 'Direcciones', 'description' => 'Gestión de direcciones.', 'route' => 'direcciones.index'],
        ['name' => 'Tipo habilidades', 'description' => 'Gestión de Tipo de habilidades.', 'route' => 't_habilidades.index'],
        ['name' => 'Duraciones', 'description' => 'Gestión de Duraciones de actividades.', 'route' => 'duraciones.index'],
        ['name' => 'Estado de Actividades', 'description' => 'Gestión de estado de actividades.', 'route' => 'e_actividades.index'],
        ['name' => 'Tipo de Mantenimiento', 'description' => 'Gestión de los tipos de mantenimiento.', 'route' => 't_mantenimientos.index'],
        ['name' => 'Estados del equipo', 'description' => 'Gestión de los estados de los equipos.', 'route' => 'e_equipos.index'],
        ['name' => 'Areas', 'description' => 'Gestión de las areas de los usuarios.', 'route' => 'areas.index'],

        // Otros CRUDs
    ];
    
    
   
    // Retornando la vista con los datos
    return view('GDS.GestionDS', compact('cruds', 'user'));}

}
