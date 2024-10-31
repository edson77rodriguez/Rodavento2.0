<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        return view('admin.dashboard', compact('user'));
    }

    public function showCrudMenu()
    {
        $user = auth()->user();

        // Lista de CRUDs
        $cruds = [
            ['name' => 'Direcciones', 'description' => 'Gestión de direcciones.', 'route' => 'direcciones.index'],
            ['name' => 'Tipo habilidades', 'description' => 'Gestión de Tipo de habilidades.', 'route' => 't_habilidades.index'],
            ['name' => 'Duraciones', 'description' => 'Gestión de Duraciones de actividades.', 'route' => 'duraciones.index'],
            ['name' => 'Estado de Actividades', 'description' => 'Gestión de estado de actividades.', 'route' => 'e_actividades.index'],
            ['name' => 'Tipo de Mantenimiento', 'description' => 'Gestión de los tipos de mantenimiento.', 'route' => 't_mantenimientos.index'],
            ['name' => 'Estados del equipo', 'description' => 'Gestión de los estados de los equipos.', 'route' => 'e_equipos.index'],
            ['name' => 'Areas', 'description' => 'Gestión de las áreas de los usuarios.', 'route' => 'areas.index'],
            // Otros CRUDs
        ];

        // Retornando la vista con los datos
        return view('GDS.GestionDS', compact('cruds', 'user'));
    }

    public function showGuias()
    {
        $user = auth()->user();
        $cruds = [
            ['name' => 'Gestion de Guias', 'description' => 'Gestión guias.', 'route' => 'asignar_guias.index'],
            ['name' => 'Gestion de las habilidades', 'description' => 'Gestión de habilidades de los guias.', 'route' => 'habilidades.index'],

            // Otros CRUDs
        ];
        return view('GDG.GestionDG', compact('cruds', 'user'));
    }
    public function showActividades()
    {
        $user = auth()->user();
        $cruds = [
            ['name' => 'Gestion de Actividades', 'description' => 'Gestión Actividades.', 'route' => 'actividades.index'],
            ['name' => 'Asignacion de Actividades', 'description' => 'Gestión de actividades asignadas.', 'route' => 'asignar_actividades.index'],

            // Otros CRUDs
        ];
        return view('GDA.GestionDA', compact('cruds', 'user'));
    }
    public function showequipos()
    {
        $user = auth()->user();
        $cruds = [
            ['name' => 'Gestión de Tipos Mantenimientos', 'description' => 'Gestión de los tipos de mantenimientos .', 'route' => 't_mantenimientos.index'],
            ['name' => 'Gestión de Estado de Equipos', 'description' => 'Gestión de los estados de equipo.', 'route' => 'e_equipos.index'],
            ['name' => 'Gestión de Las Categorias de equipo', 'description' => 'Gestión de las categorias de equipo.', 'route' => 'categorias.index'],
            ['name' => 'Gestión de Equipo', 'description' => 'Gestión de Equipo.', 'route' => 'equipos.index'],
            // Otros CRUDs que desees añadir
        ];

        return view('GDE.GestionDE', compact('cruds', 'user'));
    }
    public function gestiondeareas()
    {
        $user = auth()->user();
        $cruds = [
            ['name' => 'Gestión de areas de encargado', 'description' => 'Gestión de las areas que se le asignan a cada encargado.', 'route' => 'encargados.index'],
            ['name' => 'Gestión de areas de supervisores', 'description' => 'Gestión de las areas que se le asignan a cada supervisor', 'route' => 'supervisores.index'],


            // Otros CRUDs que desees añadir
        ];

        return view('GDAC.E', compact('cruds', 'user'));
    }

}
