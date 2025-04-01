<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobpost extends Model
{
    use HasFactory;

    protected $table = 'job_post';

    protected $fillable = [
        'title',
        'type',
        'skills',
        'industry',
        'department',
        'role',
        'mode',
        'location',
        'min_exp',
        'max_exp',
        'currency',
        'min_sal',
        'max_sal',
        'education',
        'condidate_industry',
        'diversity',
        'vacancies',
        'int_type',
        'com_name',
        'com_logo',
        'com_details',
        'job_desc',
        'admin_verify',
        'status'
    ];
}
