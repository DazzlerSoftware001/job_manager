<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobCurrency;

class JobCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobCurrency::create(['currency' => 'INR (₹)', 'status' => 0]);
        JobCurrency::create(['currency' => 'USD ($)', 'status' => 1]);
        JobCurrency::create(['currency' => 'EUR (€)', 'status' => 0]);
        JobCurrency::create(['currency' => 'GBP (£)', 'status' => 1]);
        JobCurrency::create(['currency' => 'AUD (A$)', 'status' => 1]);
    }
}
