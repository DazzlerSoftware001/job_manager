<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobDepartment extends Model
{
    use HasFactory;

    protected $table = 'job_department'; 
    protected $fillable = ['category_name', 'department', 'status'];
}