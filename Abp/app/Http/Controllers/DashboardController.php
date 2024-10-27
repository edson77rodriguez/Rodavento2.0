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
        // Otros CRUDs
    ];
    
    
   
    // Retornando la vista con los datos
    return view('GDS.GestionDS', compact('cruds', 'user'));}

}
