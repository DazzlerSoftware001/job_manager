<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class WorkProcessSectionSettings extends Model
{
    use HasFactory;

    protected $table = 'work_process_section_settings';

    protected $fillable = [
        'work_title',
        'work_message',
        'cards',
    ];

    protected $casts = [
        'cards' => 'array', // Automatically decode JSON to array
    ];
}
