<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guia extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'disponibilidad']; // Agregar 'disponibilidad' aquí


   
    public function user()
    {
        return $this->belongsTo(User::class); // Cambiar a belongsTo
    }
    public function asignarActividades()
    {
        return $this->hasMany(Asignar_actividades::class, 'guia_id');
    }
   // Método para cambiar la disponibilidad
   public function toggleDisponibilidad()
   {
       $this->disponibilidad = !$this->disponibilidad;
       $this->save(); // No olvides guardar el cambio
   }

   public function isDisponible()
   {
       return $this->disponibilidad;
   }

   public function setDisponibilidad($disponibilidad)
   {
       $this->disponibilidad = $disponibilidad;
       $this->save(); // Guarda el cambio en la base de datos
   }
}
