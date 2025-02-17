<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobExperience;

class JobExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobExperience::create(['experience' => '6 months', 'status' => 0]);
        JobExperience::create(['experience' => '1 year', 'status' => 1]);
        JobExperience::create(['experience' => '1.5 year', 'status' => 0]);
        JobExperience::create(['experience' => '2 years', 'status' => 1]);
        JobExperience::create(['experience' => '2.5 years', 'status' => 0]);
        JobExperience::create(['experience' => '3 years', 'status' => 1]);
    }
}
