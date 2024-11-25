<?php
namespace App\Http\Controllers;

use App\Models\Direccion;
use App\Models\Rol;
use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\User;
use App\Models\Guia;

class HomeController extends Controller
{
    public function showLoginForm1()
    {
        $direccions = Direccion::all(); // Cargar todas las direcciones
        $roles = Rol::all(); // Cargar todos los roles

        return view('layouts.app2', compact('direccions', 'roles')); // Pasar ambas variables a la vista
    }
    public function index()
    {
        // Obtén el usuario autenticado
        $user = auth()->user();

        // Obtén el guía asociado al usuario
        $guia = Guia::where('user_id', $user->id)->first();

        // Comprueba la disponibilidad directamente desde el modelo
        $disponible = $guia ? $guia->disponibilidad : false; // Si no hay guía, no está disponible

        // Obtén las actividades asignadas al guía, sólo si está disponible
        $actividades = $disponible ? $guia->asignarActividades : collect(); // Si no está disponible, devuelve una colección vacía

        // Pasa los datos a la vista
        return view('home', compact('user', 'guia', 'actividades'));
    }


    public function updateDisponibilidad(Request $request)
    {
        // Obtén el usuario autenticado
        $user = auth()->user();

        // Obtén el guía asociado al usuario
        $guia = Guia::where('user_id', $user->id)->first();

        if ($guia) {
            // Establece la disponibilidad según la entrada del formulario
            $disponibilidad = $request->input('disponibilidad') === 'true';

            // Actualiza la disponibilidad en la base de datos
            $guia->setDisponibilidad($disponibilidad);

            // Actualiza la disponibilidad en la sesión
            session(['disponibilidad' => $disponibilidad]);
        }

        return redirect()->back()->with('success', 'Disponibilidad actualizada con éxito.');
    }




}
