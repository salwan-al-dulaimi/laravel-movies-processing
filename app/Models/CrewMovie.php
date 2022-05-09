<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrewMovie extends Model
{
    use HasFactory;

    protected $table = 'crew_movie';


    public function crews()
    {
        return $this->hasMany(Crew::class, 'crew_movie');
    }
    public function movies()
    {
        return $this->hasMany(Movie::class, 'crew_movie');
    }
}
