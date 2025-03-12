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
        JobExperience::create(['experience' => 1, 'status' => 1]);
        JobExperience::create(['experience' => 2, 'status' => 1]);
        JobExperience::create(['experience' => 3, 'status' => 1]);
    }
}
