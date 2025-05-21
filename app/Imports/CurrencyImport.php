<?php

namespace App\Imports;

use App\Models\JobCurrency;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CurrencyImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
       foreach ($collection as $index => $row) {
            // Skip the header row if present
            if ($index === 0 && $row[0] === 'currency') {
                continue;
            }

            JobCurrency::create([
                'currency'  => $row[0],
                'status' => $row[1] !== null && $row[1] !== '' ? $row[1] : 0,
            ]);
        }
    }
}
