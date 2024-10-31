<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_id', // ID del material relacionado
        'fecha_mantenimiento', // Fecha del mantenimiento
        'tipo_m', // Tipo de mantenimiento
        'observaciones', // Observaciones sobre el mantenimiento
        'encargado_id', // ID del encargado que realizó el mantenimiento
    ];

    // Relación con el modelo Material
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id'); // Relación inversa con Material
    }

    // Relación con el modelo T_Mantenimiento
    public function tipoMantenimiento()
    {
        return $this->belongsTo(T_Mantenimiento::class, 'tipo_m'); // Relación inversa con T_Mantenimiento
    }

    // Relación con el modelo Encargado
    public function encargado()
    {
        return $this->belongsTo(Encargado::class, 'encargado_id'); // Relación inversa con Encargado
    }
}
