<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'related_id',
        'iso_639_1',
        'iso_3166_1',
        'name',
        'key',
        'site',
        'size',
        'official',
        'published_at',
    ];
}
