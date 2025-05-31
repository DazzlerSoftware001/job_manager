<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class BrandSectionSetting extends Model
{

    use HasFactory;
    
    protected $table = 'brand_section_settings';

    protected $fillable = [
        'title',
        'logos',
    ];

    protected $casts = [
        'logos' => 'array', // Cast JSON to array automatically
    ];
}
