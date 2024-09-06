<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'overview',
        'release_date',
        'language',
        'poster_path',
        'vote_average',
        'vote_count',
        'popularity',
    ];
}
