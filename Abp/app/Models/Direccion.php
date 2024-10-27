<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Direccion extends Model
{
    use HasFactory;
    protected $fillable = ['desc_direccion'];
}
