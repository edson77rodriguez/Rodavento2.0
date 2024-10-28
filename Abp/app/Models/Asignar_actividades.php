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
        return $this->belongsTo(User::class, 'guia_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function encargado()
    {
        return $this->belongsTo(User::class, 'encargado_id');
    }

    public function actividad()
    {
        return $this->belongsTo(Actividad::class);
    }

    public function estado()
    {
        return $this->belongsTo(EstadoActividad::class, 'estado_a_id');
    }
}
