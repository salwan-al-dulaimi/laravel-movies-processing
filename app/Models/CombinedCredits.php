<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CombinedCredits extends Model
{
    use HasFactory;

    public function people()
    {
        return $this->belongsTo(People::class);
    }
}
