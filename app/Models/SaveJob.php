<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaveJob extends Model
{
    use HasFactory;

    protected $table = 'save_job'; 
    protected $fillable = ['user_id', 'job_id'];

    public function user()
    {
        return $this->belongsTo(UserProfile::class, 'user_id');
    }

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class, 'job_id');
    }
}
