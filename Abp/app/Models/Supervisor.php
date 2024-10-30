<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supervisor extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','area_id'];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
    public function area()
    {
        return $this->belongsToMany(Area::class);
    }
}
