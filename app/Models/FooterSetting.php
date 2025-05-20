<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    use HasFactory;

    protected $table = 'footer_settings';

    protected $fillable = [
        'description', 'links', 'address', 'phone', 'email', 'social_links', 'copyright'
    ];

    protected $casts = [
        'links' => 'array',
        'social_links' => 'array',
    ];
}
