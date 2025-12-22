<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SparePart;

class SparePartSeeder extends Seeder
{
    public function run(): void
    {
        SparePart::create([
            'kode_part' => 'SP001',
            'nama_part' => 'Kapasitor 100uF 450V',
            'kategori' => 'Elektronik',
            'stok' => 50,
            'stok_minimum' => 10,
            'harga_beli' => 5000,
            'harga_jual' => 10000,
            'supplier' => 'PT. Elektronik Jaya',
            'keterangan' => 'Untuk TV & Power Supply',
        ]);

        SparePart::create([
            'kode_part' => 'SP002',
            'nama_part' => 'LCD Panel 14 inch',
            'kategori' => 'Display',
            'stok' => 8,
            'stok_minimum' => 3,
            'harga_beli' => 500000,
            'harga_jual' => 800000,
            'supplier' => 'CV. Display Indo',
            'keterangan' => 'Compatible Asus & Lenovo',
        ]);

        SparePart::create([
            'kode_part' => 'SP003',
            'nama_part' => 'RAM DDR4 8GB 2666MHz',
            'kategori' => 'Memory',
            'stok' => 15,
            'stok_minimum' => 5,
            'harga_beli' => 400000,
            'harga_jual' => 600000,
            'supplier' => 'PT. Komputer Nusantara',
            'keterangan' => 'Kingston/Crucial',
        ]);

        SparePart::create([
            'kode_part' => 'SP004',
            'nama_part' => 'SSD 256GB SATA',
            'kategori' => 'Storage',
            'stok' => 12,
            'stok_minimum' => 5,
            'harga_beli' => 350000,
            'harga_jual' => 550000,
            'supplier' => 'PT. Storage Solution',
            'keterangan' => 'WD/Samsung',
        ]);

        SparePart::create([
            'kode_part' => 'SP005',
            'nama_part' => 'Hard Disk 1TB',
            'kategori' => 'Storage',
            'stok' => 10,
            'stok_minimum' => 3,
            'harga_beli' => 600000,
            'harga_jual' => 900000,
            'supplier' => 'PT. Storage Solution',
            'keterangan' => 'Seagate/WD',
        ]);

        SparePart::create([
            'kode_part' => 'SP006',
            'nama_part' => 'Freon R32 1kg',
            'kategori' => 'AC',
            'stok' => 20,
            'stok_minimum' => 5,
            'harga_beli' => 200000,
            'harga_jual' => 350000,
            'supplier' => 'CV. Cooling Tech',
            'keterangan' => 'Untuk AC 1/2 - 1 PK',
        ]);

        SparePart::create([
            'kode_part' => 'SP007',
            'nama_part' => 'Thermal Paste',
            'kategori' => 'Cooling',
            'stok' => 30,
            'stok_minimum' => 10,
            'harga_beli' => 15000,
            'harga_jual' => 30000,
            'supplier' => 'Toko Komputer',
            'keterangan' => 'Arctic MX-4',
        ]);
    }
}