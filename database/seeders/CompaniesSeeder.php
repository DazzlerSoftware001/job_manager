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
       
        Companies::create([ 'name'=>'Dazzler Software',
                            'email'=>'dazzlersoft@gmail.com',
                            'phone'=>8769455933,
                            'website'=>'https://dazzlersoftware.com',
                            'address'=>'Jaipur Rajasthan',
                            'logo'=>null,
                            'status'=>1,
                        ]);
            
    }
}
