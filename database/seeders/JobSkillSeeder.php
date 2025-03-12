<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobSkill;


class JobSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobSkill::create(['skill' => 'HTML', 'status' => 0]);
        JobSkill::create(['skill' => 'CSS', 'status' => 1]);
        JobSkill::create(['skill' => 'JavaScript', 'status' => 0]);
        JobSkill::create(['skill' => 'PHP', 'status' => 1]);
        JobSkill::create(['skill' => 'Laravel', 'status' => 0]);
        JobSkill::create(['skill' => 'MySQL', 'status' => 1]);
    }
}
