<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateEmployment extends Model
{
    use HasFactory;

    protected $table = 'candidate_employment';

    protected $fillable = [
        'user_id',
        'company_name',
        'position',
        'experience',
        'description',
    ];

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class, 'user_id');
    }
}
