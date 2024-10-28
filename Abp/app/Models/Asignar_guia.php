<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Asignar_guia extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'habilidad_id',
        'fecha_emsion',
        'fecha_vencimiento',
    ];

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con Habilidad
    public function habilidad()
    {
        return $this->belongsTo(Habilidad::class);
    }
}
