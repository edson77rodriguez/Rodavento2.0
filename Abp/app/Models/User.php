<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'ap',
        'am',
        'email',
        'telefono',
        'password',
        'direccion_id',
        'rol_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'role_id');
    }

    public function direccion()
    {
        return $this->belongsTo(Direccion::class);
    }

   // Método para verificar roles usando 'nom_rol'
   public function hasRole($role)
   {
       return $this->rol->nom_rol === $role;
   }
}
