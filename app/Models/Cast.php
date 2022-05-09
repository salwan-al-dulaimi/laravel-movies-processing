<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'adult',
        'gender',
        'known_for_department',
        'name',
        'original_name',
        'popularity',
        'profile_path',
        'cast_id',
        'character',
        'credit_id',
        'order',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }

    public function tvs()
    {
        return $this->belongsToMany(Tv::class);
    }
}
