<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobPost;
use Carbon\Carbon;
class JobPostSeeder extends Seeder
{

    public function run()
    {
    $expiryDate = Carbon::now()->addDays(30)->toDateString();

        JobPost::create([
            'recruiter_id' => '2',
            'title' => 'Software Engineer',
            'type' => 'Full Time',
            'skills' => 'PHP, Laravel, JavaScript, MySQL',
            'industry' => 'IT & Software',
            'department' => 'Software Development',
            'role' => 'Backend Developer',
            'mode' => 'Remote',
            'location' => 'India - Mumbai',
            'min_exp' => 1,
            'max_exp' => 5,
            'currency' => 'INR (₹)',
            'min_sal' => 60000,
            'max_sal' => 90000,
            'sal_status' => 'off',
            'education_level' => 'UG',
            'education' => 'B.Tech',
            'branch' => 'Computer',
            'condidate_industry' => 'Software Development',
            'diversity' => 'All',
            'vacancies' => 3,
            'int_type' => 'walk in',
            'com_name' => 'Dazzler Software',
            'com_logo' => 'company/logo/default.png',
            'com_details' => 'We help businesses elevate their value through custom software development, product design, QA and consultancy services.',
            'jobexpiry' =>$expiryDate,
            'job_desc' => 'Develop and maintain web applications using Laravel.',
            'job_resp' => 'Develop and maintain web applications using Laravel.',
            'job_req' => 'Develop and maintain web applications using Laravel.',
            'admin_verify' => 0,
            'status' => 0,
        ]);
    }
}
