<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_m',
        'id_equipo',
        'estado_e_id',
        'fecha_asignacion',
        'fecha_mantenimiento',
    ];
    
    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function estadoequipo()
    {
        return $this->belongsTo(Estado_equipo::class);
    }

}