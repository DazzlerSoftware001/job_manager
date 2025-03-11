<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobRole extends Model
{
    use HasFactory;

    protected $table = 'job_role'; 
    protected $fillable = ['department_name', 'role', 'status'];
}

    

