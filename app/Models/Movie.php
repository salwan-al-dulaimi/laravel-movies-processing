<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public function casts()
    {
        return $this->hasMany(CastMovie::class);
    }

    public function crews()
    {
        return $this->hasMany(CrewMovie::class);
    }

}
