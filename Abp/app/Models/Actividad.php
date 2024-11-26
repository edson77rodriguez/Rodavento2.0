<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Actividad extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_act',
        'duracion_id',
    ];

    // Relación con User
    public function duracion()
    {
        return $this->belongsTo(Duracion::class);
    }

}
