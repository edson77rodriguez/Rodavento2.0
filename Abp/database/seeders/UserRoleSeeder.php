<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    public function run()
    {
        // Crear roles (si aún no existen)
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $supervisorRole = Role::firstOrCreate(['name' => 'supervisor']);
        $encargadoRole = Role::firstOrCreate(['name' => 'encargado']);
        $guiaRole = Role::firstOrCreate(['name' => 'guia']);

        // Asignar roles a usuarios
        $adminUser = User::find(1); // ID del administrador
        $supervisorUser = User::find(2); // ID del supervisor
        $encargadoUser = User::find(3); // ID del encargado
        $guiaUser = User::find(4); // ID del guía

        if ($adminUser) {
            $adminUser->assignRole($adminRole);
        }

        if ($supervisorUser) {
            $supervisorUser->assignRole($supervisorRole);
        }

        if ($encargadoUser) {
            $encargadoUser->assignRole($encargadoRole);
        }

        if ($guiaUser) {
            $guiaUser->assignRole($guiaRole);
        }
    }
}
