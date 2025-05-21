<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;
    
    protected $table = 'general_setting';

    protected $fillable = ['site_title', 'logo', 'light_logo', 'dark_logo'];

}
