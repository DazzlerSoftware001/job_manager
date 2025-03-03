<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruiter extends Model
{
    use HasFactory;

    protected $table = 'users'; 

    protected $fillable = ['user_type','user_details','name','email','phone','website','address','logo','status','password'];
    public $timestamps = false; 
}
