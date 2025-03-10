<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobIntType extends Model
{
    use HasFactory;

    protected $table = 'interview_type'; 
    protected $fillable = ['int_type', 'status'];
}