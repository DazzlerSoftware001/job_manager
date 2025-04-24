<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = ['id', 'user_type', 'user_details', 'name', 'lname', 'email', 'phone', 'address', 'logo', 'status', 'password', 'date_of_birth', 'gender', 'education_level', 'qualification', 'branch', 'language', 'experience', 'look_job', 'description', 'social_links', 'country', 'state', 'city', 'postal_code'];
    public $timestamps  = false;

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, 'user_id');
    }

    public function candidateProfile()
    {
        return $this->hasOne(CandidateProfile::class, 'user_id');
    }

    public function candidateEmployment()
    {
        return $this->hasMany(CandidateEmployment::class, 'user_id');
    }

    public function saveJob()
    {
        return $this->hasMany(SaveJob::class, 'user_id');
    }

}
