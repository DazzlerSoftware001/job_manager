<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class HomePageSettings extends Model
{
    use HasFactory;

    protected $table = 'home_page_settings'; 
    protected $fillable = ['banner_title', 'banner_desc','banner_filter', 'banner_image'];
    
}
