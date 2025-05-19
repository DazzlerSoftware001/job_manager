<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TableExport implements FromCollection, WithHeadings
{
    protected $table;

    public function __construct($table)
    {
        $this->table = $table;
    }

    /**
     * Fetch data from the specified table
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table($this->table)->get();
    }

    /**
     * Return column headings
     *
     * @return array
     */
    public function headings(): array
    {
        // Get the first row to extract column names
        $firstRow = (array) DB::table($this->table)->first();

        return array_keys($firstRow);
    }
}
