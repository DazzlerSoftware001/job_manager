<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CandidateQualifications extends Model
{
    use HasFactory;

    protected $table = 'education_qualifications';

    protected $fillable = [
        'user_id',
        'level',
        'board_university',
        'school_college',
        'stream',
        'starting_year',
        'passing_year',
        'percentage',
    ];

    /**
     * Relation: An education entry belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(UserProfile::class);
    }
}
