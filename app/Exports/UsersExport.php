<?php

namespace App\Exports;

use App\Models\UserProfile;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class UsersExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UserProfile::where('user_type', 0)->get([
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
