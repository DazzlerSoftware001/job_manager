<?php

namespace App\Imports;

use App\Models\JobSalary;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AnnualSalaryImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // foreach ($rows as $index => $row) {
        //     // Skip the header row if present
        //     if ($index === 0 && $row[0] === 'range') {
        //         continue;
        //     }

        //     JobSalary::create([
        //         'range' => $row[0],
        //         'status' => $row[1],
        //     ]);
        // }

         foreach ($collection as $index => $row) {
            // Skip the header row if present
            if ($index === 0 && $row[0] === 'range') {
                continue;
            }

            JobSalary::create([
                'salary'  => $row[0],
                'status' => $row[1],
            ]);
        }
    }
}
