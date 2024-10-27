<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class T_Mantenimiento extends Model
{
    use HasFactory;

    protected $fillable = ['nom_tipo','desc_m'];
}
