<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruiter extends Model
{
    use HasFactory;

    protected $table = 'users'; 

    protected $fillable = ['id','user_type','user_details','name','email','phone','logo','status','password'];
    public $timestamps = false;

    public function JobPost() {
        return $this->hasMany(JobPost::class, 'recruiter_id');
    }
}
