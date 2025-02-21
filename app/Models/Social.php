<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'people_id',
        'imdb_id',
        'facebook_id',
        'freebase_mid',
        'freebase_id',
        'tvrage_id',
        'twitter_id',
        'instagram_id',
    ];
    public function people()
    {
        return $this->belongsTo(People::class);
    }
}
