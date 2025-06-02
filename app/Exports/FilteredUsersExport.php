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

        if (!empty($this->filters['experience'])) {
            $query->where('experience', $this->filters['experience']);
        }

        if (!empty($this->filters['skills'])) {
            $query->whereJsonContains('skills', $this->filters['skills']);
        }

        // Add additional filters here if needed
        // For example:
        // if (!empty($this->filters['status'])) {
        //     $query->where('status', $this->filters['status']);
        // }

        return $query->orderBy('id', 'desc')->get([
            'id', 'name', 'email', 'phone', 'experience', 'city', 'status', 'created_at'
        ]);
    }

    public function headings(): array
    {
        return [
            'ID', 'Name', 'Email', 'Phone', 'Experience', 'City', 'Status', 'Created At'
        ];
    }
}
