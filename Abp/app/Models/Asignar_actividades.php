<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Asignar_actividades extends Model
{
    use HasFactory;

    protected $fillable = [
        'guia_id',
        'supervisor_id',
        'encargado_id',
        'actividad_id',
        'fecha_asignada',
        'estado_a_id',
    ];

    public function guia()
    {
        return $this->belongsTo(Guia::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }

    public function encargado()
    {
        return $this->belongsTo(Encargado::class);
    }

    public function actividad()
    {
        return $this->belongsTo(Actividad::class);
    }

    public function estadoActividad()
{
    return $this->belongsTo(Estado_actividad::class, 'estado_a_id'); // Asegúrate de que el segundo parámetro es correcto
}

}
