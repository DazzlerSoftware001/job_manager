<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobShift;


class JobShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobShift::create(['shift' => 'Day', 'status' => 0]);
        JobShift::create(['shift' => 'Night', 'status' => 1]);
    }
}
