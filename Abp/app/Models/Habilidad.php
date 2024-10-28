<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habilidad extends Model
{
    protected $fillable = [
        'nom_hab',
        'desc_habilidad',
        't_habilidad_id',
       
    ];

    public function tipo_habilidad()
{
    return $this->belongsTo(T_habilidad::class);
}
}
