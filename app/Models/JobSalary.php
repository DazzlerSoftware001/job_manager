<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobSalary extends Model
{
    use HasFactory;

    protected $table = 'annual_salary'; 
    protected $fillable = ['salary', 'status'];
}
