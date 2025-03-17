<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recruiter;

class RecruitersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Recruiter::create([ 
            'user_type'=>2,
            'user_details'=>'Recruiter',
            'name'=>'Akash',
            'email'=>'akash@gmail.com',
            'phone'=>'0000000000',
            'logo'=>null,
            'status'=>0,
            'password'=>'$2y$10$gJ7S2l4i/iMKD8gzulW/ku4DZWMgNYz1v4pqhWXznDPucPB.FLn7S',
            'created_at'=>now(),
        ]);
    }
}
