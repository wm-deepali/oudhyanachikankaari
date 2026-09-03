<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoPage extends Model
{
    protected $fillable = [
        'page_key',
        'page_name',
        'slug',
        'meta_title',
        'meta_description',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'og_url',
        'twitter_card',
        'twitter_image',
        'scripts',
    ];
    
}