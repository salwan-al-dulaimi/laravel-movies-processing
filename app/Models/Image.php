<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'related_id',
        'aspect_ratio',
        'file_path',
        'height',
        'iso_639_1',
        'vote_average',
        'vote_count',
        'width',
    ];
}
