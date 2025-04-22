<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateProfile extends Model
{
    use HasFactory;

    protected $table = 'candidate_profile';

    protected $fillable = [
        'user_id',
        'resume',
        'cover_letter',
        'skill',
        'company',
        'position',
        'experience',
        'description',
    ];

    // Relationship: CandidateProfile belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
