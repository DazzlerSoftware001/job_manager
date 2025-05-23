<?php

namespace App\Imports;

use App\Models\JobCategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class JobCategoryImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $index => $row) {
            // Skip the header row if present
            if ($index === 0 && $row[0] === 'name') {
                continue;
            }

            JobCategory::create([
                'name'  => $row[0],
                'status' => $row[1] !== null && $row[1] !== '' ? $row[1] : 0,
            ]);
        }
    }
}
