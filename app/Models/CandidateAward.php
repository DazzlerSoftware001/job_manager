<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CandidateAward extends Model
{
    use HasFactory;
    
    protected $table = 'candidate_award';

    protected $fillable = [
        'user_id',
        'award_title',
        'award_date',
        'award_desc',
    ];

    public function user()
    {
        return $this->belongsTo(UserProfile::class);
    }

}
