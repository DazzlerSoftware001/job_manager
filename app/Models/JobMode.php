<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobMode extends Model
{
    use HasFactory;

    protected $table = 'job_mode'; 

    protected $fillable = ['mode', 'status'];
}
