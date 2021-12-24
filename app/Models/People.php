<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    public function socials()
    {
        return $this->hasMany(Social::class);
    }

    public function combinedcredits()
    {
        return $this->hasMany(CombinedCredits::class, 'id');
    }
}
