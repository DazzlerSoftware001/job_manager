<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'users'; 

    protected $fillable = ['id','user_type','user_details','name','lname','email','phone','address','logo','status','password','date_of_birth','gender','education_level','qualification','branch','language','experience','look_job','description','social_links','country','state','postal_code'];
    public $timestamps = false; 
}
