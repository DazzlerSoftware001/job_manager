<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobIntType;

class JobIntTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobIntType::create(['int_type' => 'walk in', 'status' => 0]);
        JobIntType::create(['int_type' => 'online', 'status' => 1]);
        JobIntType::create(['int_type' => 'face to face', 'status' => 0]);
    }
}
