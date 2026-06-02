<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    protected $fillable = [
        'logo',
        'about_text',
        'address',
        'phone',
        'whatsapp',
        'email',
        'email2',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'status',
    ];
}