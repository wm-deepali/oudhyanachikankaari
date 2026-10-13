<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
        'has_values',
        'status',
        'show_in_navbar', // added
        'seo_required'
    ];

    protected $casts = [
        'has_values'     => 'boolean',
        'status'         => 'boolean',
        'show_in_navbar' => 'boolean', // added
        'seo_required' => 'boolean'
    ];

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function categoryAttributes()
    {
        return $this->hasMany(CategoryAttribute::class);
    }
}