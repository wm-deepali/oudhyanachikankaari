<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeHero extends Model
{
    protected $fillable = [
        'trusted_text',
        'title_black_1',
        'title_gradient',
        'title_black_2',
        'description',
        'image',
    ];
}
