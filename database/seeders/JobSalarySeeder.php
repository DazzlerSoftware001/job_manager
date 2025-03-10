<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobSalary;

class JobSalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobSalary::create(['salary' => '10,000', 'status' => 0]);
        JobSalary::create(['salary' => '20,000', 'status' => 1]);
        JobSalary::create(['salary' => '40,000', 'status' => 0]);
        JobSalary::create(['salary' => '50,000', 'status' => 1]);
    }
}
