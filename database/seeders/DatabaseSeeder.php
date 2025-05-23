<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            JobLocationSeeder::class,
            JobCategorySeeder::class,
            JobTypesSeeder::class,
            JobShiftSeeder::class,
            JobExperienceSeeder::class,
            JobSkillSeeder::class,
            JobDepartmentSeeder::class,
            CompaniesSeeder::class,
            RecruitersSeeder::class,
            JobRoleSeeder::class,
            JobModeSeeder::class,
            JobIntTypeSeeder::class,
            JobCurrencySeeder::class,
            JobSalarySeeder::class,
            AdminSeeder::class,
            JobEducationSeeder::class,
            JobPostSeeder::class,
            UserProfileSeeder::class,
        ]);
    }
}
