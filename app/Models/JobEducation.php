<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobEducation extends Model
{
    use HasFactory;

    protected $table = 'education'; 
    protected $fillable = ['education_level','education','branch', 'status'];
}