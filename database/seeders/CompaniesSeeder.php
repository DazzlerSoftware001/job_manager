<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Companies;


class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        Companies::create(['user_type' => 2,
                            'user_details' => 'Recruiter',
                            'name'=>'Dazzler Software',
                            'email'=>'dazzlersoft@gmail.com',
                            'phone'=>8769455933,
                            'website'=>'https://dazzlersoftware.com',
                            'address'=>'Jaipur Rajasthan',
                            'logo'=>null,
                            'status'=>1,
                            'password'=>'$2y$10$d1pVUSSGxGX2VxqOBXLB2uVwnyx4EwTmUsdfPxC68B3PRfy.ekziS',
                        ]);
            
    }
}
