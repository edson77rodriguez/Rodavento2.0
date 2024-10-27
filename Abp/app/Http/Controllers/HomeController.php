<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        // Asumiendo que el usuario está autenticado, recuperamos sus datos
        $user = auth()->user();  // Obtiene el objeto del usuario autenticado

        // Pasamos los datos del usuario a la vista
        return view('home', compact('user'));
    }
  
}
