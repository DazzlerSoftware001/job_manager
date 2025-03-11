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
        JobRole::create(['category_name' => 'IT & Software','department' => 'Software Development', 'status' => 1]);
        JobRole::create(['category_name' => 'Finance','department' => 'Accounting', 'status' => 1]);
        JobRole::create(['category_name' => 'Healthcare', 'department' => 'Pharmaceuticals', 'status' => 1]);
    }
}
