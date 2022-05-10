<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crew extends Model
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
        'credit_id',
        'department',
        'job',
    ];
}
