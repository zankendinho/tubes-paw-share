<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Technician;

class TechnicianSeeder extends Seeder
{
    public function run(): void
    {
        Technician::create([
            'user_id' => 2, // Budi Santoso
            'spesialisasi' => 'TV, Audio, AC',
            'pengalaman' => 5,
            'rating' => 4.5,
            'total_servis' => 120,
            'status' => 'tersedia',
        ]);

        Technician::create([
            'user_id' => 3, // Andi Wijaya
            'spesialisasi' => 'Laptop, PC, Elektronik',
            'pengalaman' => 3,
            'rating' => 4.2,
            'total_servis' => 85,
            'status' => 'tersedia',
        ]);
    }
}