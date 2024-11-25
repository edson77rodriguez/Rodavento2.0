<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use App\Models\Rol;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function showLoginForm1()
    {
        $direccions = Direccion::all(); // Cargar todas las direcciones
        $roles = Rol::all(); // Cargar todos los roles

        return view('layouts.app2', compact('direccions', 'roles')); // Pasar ambas variables a la vista
    }
    use AuthorizesRequests, ValidatesRequests;
}
