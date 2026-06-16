<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'tagline',
        'logo',
        'favicon',

        'admin_email',
        'support_email',
        'phone',
        'whatsapp',
        'business_address',

        'footer_description',
        'footer_copyright',
        'google_map_url',

        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'youtube',
        'pinterest',

        'currency',
        'currency_symbol',
        'timezone',

        'maintenance_mode',
        'admin_session_timeout',
        'product_reviews',
        'wishlist',
        'stock_alerts',
    ];

    protected $casts = [
        'maintenance_mode' => 'boolean',
        'product_reviews' => 'boolean',
        'wishlist' => 'boolean',
        'stock_alerts' => 'boolean',
    ];
}