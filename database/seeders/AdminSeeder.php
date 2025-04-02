<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'user_type'=>1,
            'user_details'=>'Admin',
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'phone'=>'1111122222',
            'logo'=>null,
            'password'=>'$2y$10$TBeIZDaskBfHsXwpotQ/bekSuqSbY09XMHxI174WSxjY8TT3LFYxm',
            'created_at'=>now(),
        ]);
    }
}
