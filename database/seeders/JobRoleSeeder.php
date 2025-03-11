<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobRole;

class JobRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobRole::create(['department_name' => 'Software Development', 'role' => 'Backend Developer', 'status' => 1]);
        JobRole::create(['department_name' => 'Accounting', 'role' => ' Accountant', 'status' => 1]);
        JobRole::create(['department_name' => 'Pharmaceuticals', 'role' => 'Pharmacist', 'status' => 1]);
    }
}