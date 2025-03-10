<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobDepartment;

class JobDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobRole::create(['department' => 'Software Development', 'status' => 0]);
        JobRole::create(['department' => 'Service Deapartment', 'status' => 1]);
        JobRole::create(['department' => 'Electrician Department', 'status' => 0]);
    }
}
