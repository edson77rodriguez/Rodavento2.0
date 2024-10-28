<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name'];

    // Define la relación con roles
    public function roles()
    {
        return $this->belongsToMany(Rol::class);
    }
}
