<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
        return view('dashboard',compact('user'));
    }
    public function showCrudMenu()
{
    $user = auth()->user(); // Obtén el usuario autenticado
    // Lista de CRUDs (puede ser dinámica dependiendo de tu sistema)
    $cruds = [
        ['name' => 'Usuarios', 'route' => 'users.index', 'description' => 'Gestión de usuarios del sistema.'],
        ['name' => 'Productos', 'route' => 'products.index', 'description' => 'Control de inventario y productos.'],
        ['name' => 'Ventas', 'route' => 'sales.index', 'description' => 'Registro y administración de ventas.'],
        ['name' => 'Clientes', 'route' => 'clients.index', 'description' => 'Administración de información de clientes.'],
        // Agrega más módulos según sea necesario
    ];
   
    // Retornando la vista con los datos
    return view('GDS.GestionDS', compact('cruds', 'user'));}

}
