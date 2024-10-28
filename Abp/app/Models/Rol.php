<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class Rol extends Model
{
    use HasFactory, HasRoles;

    // Utiliza HasRoles del paquete Spatie

    protected $table = 'rols';
    protected $fillable = ['nom_rol', 'guard_name']; // Agregar 'guard_name'

    // Relación con el modelo User
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
