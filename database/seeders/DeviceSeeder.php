<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Device;

class DeviceSeeder extends Seeder
{
    public function run(): void
    {
        Device::create([
            'customer_id' => 1, // Ahmad Rizki
            'kategori' => 'TV',
            'merk' => 'Samsung',
            'model' => 'UA43T6500',
            'serial_number' => 'SN001234',
            'tahun_beli' => 2020,
            'kondisi' => 'Baik, pemakaian normal',
        ]);

        Device::create([
            'customer_id' => 1, // Ahmad Rizki
            'kategori' => 'AC',
            'merk' => 'Daikin',
            'model' => 'FTV25BXV14',
            'serial_number' => 'SN001235',
            'tahun_beli' => 2019,
            'kondisi' => 'Service rutin pertama',
        ]);

        Device::create([
            'customer_id' => 2, // Siti Nurhaliza
            'kategori' => 'Laptop',
            'merk' => 'Asus',
            'model' => 'VivoBook A412DA',
            'serial_number' => 'SN001236',
            'tahun_beli' => 2021,
            'kondisi' => 'Laptop panas, kadang freeze',
        ]);

        Device::create([
            'customer_id' => 3, // Dedi Kurniawan
            'kategori' => 'PC',
            'merk' => 'Custom Build',
            'model' => 'Gaming PC Intel i5',
            'serial_number' => 'SN001237',
            'tahun_beli' => 2022,
            'kondisi' => 'Tidak bisa booting',
        ]);

        Device::create([
            'customer_id' => 2, // Siti Nurhaliza
            'kategori' => 'Kulkas',
            'merk' => 'LG',
            'model' => 'GN-B202SQBB',
            'serial_number' => 'SN001238',
            'tahun_beli' => 2018,
            'kondisi' => 'Kurang dingin',
        ]);

        Device::create([
            'customer_id' => 3, // Dedi Kurniawan
            'kategori' => 'Laptop',
            'merk' => 'Lenovo',
            'model' => 'IdeaPad Slim 3',
            'serial_number' => 'SN001239',
            'tahun_beli' => 2023,
            'kondisi' => 'Layar bergaris',
        ]);
    }
}