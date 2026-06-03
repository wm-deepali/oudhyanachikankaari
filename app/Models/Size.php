<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'size_group_id',
        'name',
        'sort_order',
        'status',
    ];

    public function sizeGroup()
    {
        return $this->belongsTo(SizeGroup::class);
    }
}