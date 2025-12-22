<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::create([
            'user_id' => 4, // Ahmad Rizki
            'nama' => 'Ahmad Rizki',
            'email' => 'ahmad@gmail.com',
            'telp' => '081234567893',
            'alamat' => 'Jl. Merdeka No. 10, Jakarta Pusat',
            'tanggal_daftar' => '2024-01-15',
        ]);

        Customer::create([
            'user_id' => 5, // Siti Nurhaliza
            'nama' => 'Siti Nurhaliza',
            'email' => 'siti@gmail.com',
            'telp' => '081234567894',
            'alamat' => 'Jl. Sudirman No. 25, Bandung',
            'tanggal_daftar' => '2024-02-20',
        ]);

        Customer::create([
            'user_id' => 6, // Dedi Kurniawan
            'nama' => 'Dedi Kurniawan',
            'email' => 'dedi@gmail.com',
            'telp' => '081234567895',
            'alamat' => 'Jl. Gatot Subroto No. 5, Surabaya',
            'tanggal_daftar' => '2024-03-10',
        ]);
    }
}