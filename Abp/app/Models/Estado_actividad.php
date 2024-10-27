<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Estado_actividad;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Estado_actividad extends Model
{
    use HasFactory;

    protected $fillable = ['desc_estado_a'];
}
