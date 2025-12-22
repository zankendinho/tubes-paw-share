<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'nama' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@simse.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'telp' => '081234567890',
            'foto' => 'default.jpg',
            'status' => 'aktif',
        ]);

        // Teknisi 1
        User::create([
            'nama' => 'Budi Santoso',
            'username' => 'teknisi1',
            'email' => 'budi@simse.com',
            'password' => Hash::make('teknisi123'),
            'role' => 'admin',
            'telp' => '081234567891',
            'foto' => 'default.jpg',
            'status' => 'aktif',
        ]);

        // Teknisi 2
        User::create([
            'nama' => 'Andi Wijaya',
            'username' => 'teknisi2',
            'email' => 'andi@simse.com',
            'password' => Hash::make('teknisi123'),
            'role' => 'admin',
            'telp' => '081234567892',
            'foto' => 'default.jpg',
            'status' => 'aktif',
        ]);

        // Customer 1
        User::create([
            'nama' => 'Ahmad Rizki',
            'username' => 'customer1',
            'email' => 'ahmad@gmail.com',
            'password' => Hash::make('customer123'),
            'role' => 'customer',
            'telp' => '081234567893',
            'foto' => 'default.jpg',
            'status' => 'aktif',
        ]);

        // Customer 2
        User::create([
            'nama' => 'Siti Nurhaliza',
            'username' => 'customer2',
            'email' => 'siti@gmail.com',
            'password' => Hash::make('customer123'),
            'role' => 'customer',
            'telp' => '081234567894',
            'foto' => 'default.jpg',
            'status' => 'aktif',
        ]);

        // Customer 3
        User::create([
            'nama' => 'Dedi Kurniawan',
            'username' => 'customer3',
            'email' => 'dedi@gmail.com',
            'password' => Hash::make('customer123'),
            'role' => 'customer',
            'telp' => '081234567895',
            'foto' => 'default.jpg',
            'status' => 'aktif',
        ]);
    }
}