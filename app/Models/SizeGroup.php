<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sort_order',
        'status',
    ];

    public function sizes()
    {
        return $this->hasMany(Size::class);
    }
}