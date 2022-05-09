<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'adult',
        'backdrop_path',
        'budget',
        'genres',
        'homepage',
        'imdb_id',
        'original_language',
        'original_title',
        'overview',
        'popularity',
        'poster_path',
        'production_companies',
        'production_countries',
        'release_date',
        'revenue',
        'runtime',
        'spoken_languages',
        'status',
        'tagline',
        'title',
        'video',
        'vote_average',
        'vote_count'
    ];

    public function casts()
    {
        return $this->hasMany(CastMovie::class);
    }

    public function crews()
    {
        return $this->hasMany(CrewMovie::class);
    }
}
