<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    protected $table = 'job_post';

    protected $fillable = [
        'recruiter_id',
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
        'sal_status',
        'education_level',
        'education',
        'branch',
        'condidate_industry',
        'diversity',
        'vacancies',
        'int_type',
        'com_name',
        'com_logo',
        'com_details',
        'jobexpiry',
        'job_desc',
        'job_resp',
        'job_req',
        'admin_verify',
        'status'
    ];

    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }
    public function saveJob()
    {
        return $this->hasMany(SaveJob::class, 'job_id');
    }

    public function recruiter() {
        return $this->belongsTo(Recruiter::class, 'recruiter_id');
    }

    
}
