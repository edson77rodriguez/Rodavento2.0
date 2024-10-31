<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';

    // Especificar la clave primaria si no es "id"
    protected $primaryKey = 'id_equipo';

    protected $fillable = [
        'nom_equipo',
        'categoria_id',  
        'descripcion',
        'cantidad',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    
}
