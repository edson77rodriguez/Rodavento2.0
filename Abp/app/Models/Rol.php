<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rol extends Model
{
    use HasFactory;

    protected $fillable = ['nom_rol'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
