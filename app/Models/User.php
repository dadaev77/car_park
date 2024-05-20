<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
