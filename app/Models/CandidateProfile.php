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
        'position',
        'expect_sal',
        'view_profile',
    ];

    public function user()
    {
        return $this->belongsTo(UserProfile::class);
    }

}
