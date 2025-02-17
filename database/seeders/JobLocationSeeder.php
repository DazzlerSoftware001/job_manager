<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobLocation;
class JobLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobLocation::create(['country' => 'India', 'city' => 'Mumbai', 'status' => 1]);
        JobLocation::create(['country' => 'USA', 'city' => 'New York', 'status' => 0]);
    }
}
