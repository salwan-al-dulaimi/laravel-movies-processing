<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable= ['favorite_id', 'user_id'];
    protected $table = 'user_favorite';

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'user_favorite');
    }
    
}
