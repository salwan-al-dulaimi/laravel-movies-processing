<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tv extends Model
{
    use HasFactory;

    public function casts()
    {
        return $this->hasMany(CastTv::class);
    }

    public function crews()
    {
        return $this->hasMany(CrewTv::class);
    }
}
