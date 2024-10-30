<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // Asegúrate de importar el trait
class User extends Authenticatable
{
    use HasFactory, HasRoles; // Añade HasRoles aquí


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

    

    public function direccion()
    {
        return $this->belongsTo(Direccion::class);
    }

   // En el modelo User
public function rol()
{
    return $this->belongsTo(Rol::class);
}

}
