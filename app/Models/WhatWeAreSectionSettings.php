<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class WhatWeAreSectionSettings extends Model
{

    use HasFactory;

    protected $table = 'what_we_are_settings';

    protected $fillable = [
        'show_section',
        'section_image',
        'title',
        'description',
        'points',
        'button_text'
    ];

    protected $casts = [
        'points' => 'array', // Cast JSON to array automatically
    ];
}
