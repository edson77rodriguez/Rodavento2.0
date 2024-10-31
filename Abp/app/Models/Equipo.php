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
        'id',  // Este es el campo que se usa como clave foránea para la categoría
        'descripcion',
        'cantidad',
    ];

    // Relación con el modelo de categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id'); // Usar 'id' para la relación
    }
}
