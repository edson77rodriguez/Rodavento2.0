<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Asignar_Equipo extends Model
{
    use HasFactory;
    protected $fillable = [
        'material_id',
        'guia_id',
        'actividad_id',
        'fecha_programada',
        'fecha_devolucion',
    ];

    public function guia()
    {
        return $this->belongsTo(Guia::class, 'guia_id');
    }
    
    
    public function actividad()
    {
        return $this->belongsTo(Actividad::class);
    }
    public function material()
    {
        return $this->belongsTo(Material::class); // Relación inversa con Material
    }
}
