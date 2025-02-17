<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobLocation extends Model
{
    use HasFactory;

    protected $table = 'job_location'; // Define table name

    protected $fillable = ['country', 'city', 'status']; // Allow mass assignment
}
