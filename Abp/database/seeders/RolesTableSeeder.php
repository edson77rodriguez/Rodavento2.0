<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = ['Administrador', 'Supervisor', 'Encargado', 'Guia'];

        foreach ($roles as $role) {
            Rol::create(['nom_rol' => $role]); // Usa 'nom_rol' aquí
        }
    }
}
