<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}