<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailTemplates extends Model
{
    use HasFactory;

    protected $table = 'email_templates'; 
    protected $fillable = ['user_type','send_to','name','show_email', 'subject', 'body'];
}
