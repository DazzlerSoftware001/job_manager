<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobTypes;


class JobTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobTypes::create(['type' => 'Full Time', 'status' => 0]);
        JobTypes::create(['type' => 'Part Time', 'status' => 0]);
        JobTypes::create(['type' => 'WFH', 'status' => 1]);
        JobTypes::create(['type' => 'Hybrid', 'status' => 1]);
    }
}
