<?php

namespace App\Exports;

use App\Models\UserProfile;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FilteredUsersExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = UserProfile::query()->where('user_type', 0);

        if (!empty($this->filters['city'])) {
            $query->where('city', $this->filters['city']);
        }

        if (!empty($this->filters['education_level'])) {
            $query->where('education_level', $this->filters['education_level']);
        }

        if (!empty($this->filters['Qualification'])) {
            $query->where('qualification', $this->filters['Qualification']);
        }

        if (!empty($this->filters['Branch'])) {
            $query->where('branch', $this->filters['Branch']);
        }

        // if (!empty($this->filters['experience'])) {
        //     $experienceArray = explode(',', $this->filters['experience']);
        //     $query->whereIn('experience', $experienceArray);
        // }

        if (!empty($this->filters['experience'])) {
            $experience = explode(',', $this->filters['experience']);
            $experience = array_map('intval', $experience);

            if (!empty($experience)) {
                $min = min($experience);
                $max = max($experience);
                $query->whereBetween('experience', [$min, $max]);
            }
        }

        if (!empty($this->filters['skills'])) {
            $query->whereJsonContains('skills', $this->filters['skills']);
        }

        return $query->orderBy('id', 'desc')->get([
            'id', 'name', 'email', 'phone', 'experience', 'city', 'qualification', 'branch', 'status', 'created_at'
        ]);
    }

    public function headings(): array
    {
        return [
            'ID', 'Name', 'Email', 'Phone', 'Experience', 'City', 'Qualification', 'Branch', 'Status', 'Created At'
        ];
    }
}
