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
        JobEducation::create(['education_level' => 'UG','education' => 'BCA', 'status' => 1]);
        JobEducation::create(['education_level' => 'PG','education' => 'MCA', 'status' => 1]);
        JobEducation::create(['education_level' => 'UG','education' => 'B.Tech', 'branch'=> 'Computer', 'status' => 1]);
    }
}