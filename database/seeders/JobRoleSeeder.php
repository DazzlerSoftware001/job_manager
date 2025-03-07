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
        JobRole::create(['role' => 'Backend Developer', 'status' => 0]);
        JobRole::create(['role' => 'Frontend Developer', 'status' => 1]);
        JobRole::create(['role' => 'Fullstack Developer', 'status' => 0]);
    }
}