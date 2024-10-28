<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function assignRoles()
    {
        // Crear roles (si aún no existen)
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'supervisor']);
        Role::firstOrCreate(['name' => 'encargado']);
        Role::firstOrCreate(['name' => 'guia']);

        // Asignar roles a usuarios
        $this->assignRoleToUser(1, 'admin'); // ID del administrador
        $this->assignRoleToUser(2, 'supervisor'); // ID del supervisor
        $this->assignRoleToUser(3, 'encargado'); // ID del encargado
        $this->assignRoleToUser(4, 'guia'); // ID del guía

        return 'Roles asignados correctamente.';
    }

    private function assignRoleToUser($userId, $roleName)
    {
        $user = User::find($userId);
        if ($user) {
            $user->assignRole($roleName);
        }
    }
}
