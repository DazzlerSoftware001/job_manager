<?php
namespace App\Exports;

use App\Models\JobApplication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FilterApplicantsExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $filters = $this->filters;

        $recruiter       = $filters['recruiter'];
        $job             = $filters['job'];
        $city            = $filters['city'] ?? null;
        $education_level = $filters['education_level'] ?? null;
        $Qualification   = $filters['Qualification'] ?? null;
        $Branch          = $filters['Branch'] ?? null;
        $experience      = $filters['experience'] ?? null;
        $skills          = $filters['skills'] ?? [];

        $query = JobApplication::with([
            'user:id,name,lname,email,education_level,qualification,branch,city,experience',
            'user.candidateProfile',
            'jobPost:id,title',
        ])->select(['id', 'user_id', 'job_id', 'status', 'recruiter_view', 'created_at']);

        if ($job) {
            $query->where('job_id', $job);
        }

        if ($city) {
            $query->whereHas('user', fn($q) => $q->where('city', $city));
        }

        if ($education_level) {
            $query->whereHas('user', fn($q) => $q->where('education_level', $education_level));
        }

        if ($Qualification) {
            $query->whereHas('user', fn($q) => $q->where('qualification', 'like', '%' . $Qualification . '%'));
        }

        if ($Branch) {
            $query->whereHas('user', fn($q) => $q->where('branch', 'like', '%' . $Branch . '%'));
        }

        if (! empty($this->filters['experience'])) {
            $expRange = explode(',', $this->filters['experience']);
            $expRange = array_map('intval', $expRange);

            if (count($expRange) === 2) {
                [$min, $max] = $expRange;
                $query->whereHas('user', fn($q) => $q->whereBetween('experience', [$min, $max]));
            }
        }

        if (! empty($skills)) {
            $query->whereHas('user.candidateProfile', function ($q) use ($skills) {
                $q->where(function ($q2) use ($skills) {
                    foreach ($skills as $skill) {
                        $q2->Where('skill', 'like', '%' . $skill . '%');
                    }
                });
            });
        }

        $applications = $query->get();

        return $applications->map(function ($app) {
            return [
                $app->id,
                $app->user->name . ' ' . $app->user->lname,
                $app->user->email,
                $app->jobPost->title ?? 'N/A',
                $app->status,
                $app->recruiter_view ? 'Viewed' : 'Not Viewed',
                $app->created_at->format('Y-m-d H:i:s'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'User Name',
            'User Email',
            'Job Title',
            'Status',
            'Recruiter View',
            'Applied At',
        ];
    }
}
