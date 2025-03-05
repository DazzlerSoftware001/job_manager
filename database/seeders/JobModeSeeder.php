<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobMode;

class JobModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobMode::create(['mode' => 'WFH', 'status' => 0]);
        JobMode::create(['mode' => 'WFO', 'status' => 1]);
        JobMode::create(['mode' => 'Remote', 'status' => 0]);
        JobMode::create(['mode' => 'Hybrid', 'status' => 1]);
    }
}
