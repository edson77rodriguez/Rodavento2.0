<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
   
    public function run()
    {
        $permissions = [
            'manage roles',
            'edit articles',
            'delete articles',
            'view users',
            'manage users',
            // Agrega más permisos según sea necesario
        ];

        foreach ($permissions as $permission) {
            // Verificar si el permiso ya existe antes de crearlo
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }
    }
}
