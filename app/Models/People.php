<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'birthday',
        'known_for_department',
        'deathday',
        'also_known_as',
        'gender',
        'biography',
        'popularity',
        'place_of_birth',
        'profile_path',
        'adult',
        'imdb_id',
        'homepage'
    ];

    public function socials()
    {
        return $this->hasMany(Social::class);
    }

    public function combinedcredits()
    {
        return $this->hasMany(CombinedCredits::class, 'id');
    }
}
