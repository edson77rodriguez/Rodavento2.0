<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Encargado extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','area_id'];

    public function user()
    {
        return $this->belongsTo(User::class); // Cambiar a belongsTo
    }
    public function area()
    {
        return $this->belongsToMany(Area::class);
    }
}
