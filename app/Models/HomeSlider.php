<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSlider extends Model
{
    protected $fillable = [
        'image',
        'mobile_image',
        'link',
        'sort_order',
        'status'
    ];
}