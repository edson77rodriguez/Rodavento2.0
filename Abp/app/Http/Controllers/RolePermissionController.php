<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function showAssignForm()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('roles-permissions', compact('roles', 'permissions'));
    }

    public function assignPermissions(Request $request)
    {
        $role = Role::findById($request->input('role_id'));
        $permissions = $request->input('permissions', []);

        // Asignar los permisos seleccionados al rol
        $role->syncPermissions($permissions);

        return redirect()->back()->with('success', 'Permisos asignados correctamente.');
    }
}
