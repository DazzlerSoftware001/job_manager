<?php

namespace App\Imports;

use App\Models\JobLocation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class JobLocationImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $index => $row) {
        // Skip the header row if present
        if ($index === 0 && $row[0] === 'country') {
            continue;
        }

        JobLocation::create([
            'country'  => $row[0],
            'city'  => $row[1],
            'status' => $row[2] !== null && $row[2] !== '' ? $row[2] : 0,
        ]);
        }
    }
}
