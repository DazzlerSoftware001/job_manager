<?php

namespace App\Imports;
use App\Models\JobSkill;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SkillImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $index => $row) {
            // Skip the header row if present
            if ($index === 0 && $row[0] === 'skill') {
                continue;
            }

            JobSkill::create([
                'skill'  => $row[0],
                'status' => $row[1] !== null && $row[1] !== '' ? $row[1] : 0,
            ]);
        }
    }
}
