<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'ap',
        'am',
        'email',
        'telefono',
        'fecha_nac',
        'codigo_usuario',
        'password',
        'rol_id',
    ];

    /**
     * Los atributos que deben estar ocultos en arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben ser tratados como tipos de fecha.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'fecha_nac' => 'date',
    ];

    /**
     * Relación con el modelo Rol.
     */
    public function rol()
    {
        return $this->belongsTo(Role::class);
    }
}
