<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobCategory;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobCategory::create(['name' => 'IT & Software', 'status' => 0]);
        JobCategory::create(['name' => 'Marketing', 'status' => 0]);
        JobCategory::create(['name' => 'Finance', 'status' => 1]);
        JobCategory::create(['name' => 'Healthcare', 'status' => 1]);
        JobCategory::create(['name' => 'Education', 'status' => 1]);
    }
}
