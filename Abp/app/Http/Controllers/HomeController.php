<?php
namespace App\Http\Controllers;

use App\Models\Direccion;
use App\Models\Rol;
use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Asignar_Equipo;
use App\Models\User;
use App\Models\Encargado;
use App\Models\Guia;
use App\Models\Mantenimiento;


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
        $asignaciones = Asignar_Equipo::with(['actividad', 'material.equipo'])->get();


        // Pasa los datos a la vista
        return view('home', compact('user', 'guia', 'actividades','asignaciones'));
    }

    public function indexencargado()
{
    // Obtén el usuario autenticado
    $user = auth()->user();

    // Obtén el encargado asociado al usuario
    $encargado = Encargado::where('user_id', $user->id)->first();

    // Si no hay encargado, regresa una vista vacía o con mensaje de error
    if (!$encargado) {
        return view('home', [
            'user' => $user,
            'encargado' => null,
            'actividades' => collect(),
            'asignaciones' => collect(),
            'mantenimientos' => collect(),
        ]);
    }

    // Verifica si el encargado tiene actividades asignadas
    $actividades = $encargado->asignarActividades ?? collect();

    // Obtén las asignaciones con relaciones cargadas
    $asignaciones = Asignar_Equipo::with(['actividad', 'material.equipo'])->get();

    // Obtén los mantenimientos realizados por el encargado
    $mantenimientos = Mantenimiento::with(['material', 'tipoMantenimiento'])
        ->where('encargado_id', $encargado->id)
        ->get();

    // Pasa los datos a la vista
    return view('encargados.home', compact('user', 'encargado', 'actividades', 'asignaciones', 'mantenimientos'));
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
