<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $table = 'job_applications'; 
    protected $fillable = ['user_id', 'job_id','status', 'recruiter_view'];

    public function user()
    {
        return $this->belongsTo(UserProfile::class, 'user_id');
    }

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class, 'job_id');
    }
}
