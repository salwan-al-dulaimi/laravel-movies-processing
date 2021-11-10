<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CastMovie extends Model
{
    use HasFactory;

    protected $table = 'cast_movie';

    public function casts()
    {
        return $this->hasMany(Cast::class, 'cast_movie');
    }
    public function movies()
    {
        return $this->hasMany(Movie::class, 'cast_movie');
    }
}
