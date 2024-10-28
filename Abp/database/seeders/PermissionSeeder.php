<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'create-posts',
            'edit-posts',
            'delete-posts',
            'view-posts',
            'manage-users',
        ];

        foreach ($permissions as $permission) {
            // Verificar si el permiso ya existe antes de crearlo
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }
    }
}
