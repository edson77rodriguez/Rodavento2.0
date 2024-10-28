<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class Rol extends Model
{
    use HasFactory, HasRoles; // Agrega HasRoles aquí

    protected $table = 'rols';
    protected $fillable = ['nom_rol'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
   
    public function permissions()
{
    return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id', 'permission_id');
}
};
