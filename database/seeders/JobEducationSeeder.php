<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobEducation;

class JobEducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobEducation::create(['education' => 'BCA', 'status' => 1]);
        JobEducation::create(['education' => 'MCA', 'status' => 1]);
        JobEducation::create(['education' => 'B.Tech', 'status' => 1]);
    }
}