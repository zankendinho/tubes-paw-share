<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CustomerSeeder::class,
            TechnicianSeeder::class,
            DeviceSeeder::class,
            SparePartSeeder::class,
            ServiceSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}