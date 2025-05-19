<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterLogo extends Model
{
    use HasFactory;
    
    protected $fillable = ['logo', 'light_logo', 'dark_logo'];

}
