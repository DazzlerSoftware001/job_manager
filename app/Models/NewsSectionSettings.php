<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class NewsSectionSettings extends Model
{

    use HasFactory;

    protected $table = 'news_section_settings';

    protected $fillable = [
        'news_title',
        'news_message',
        'cards',
    ];

    protected $casts = [
        'cards' => 'array', // Automatically decode JSON to array
    ];
}
