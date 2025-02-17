<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSkill extends Model
{
    use HasFactory;

    protected $table = 'job_skill'; 
    protected $fillable = ['skill', 'status'];
}
