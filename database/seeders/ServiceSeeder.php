<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::create([
            'kode_servis' => 'SRV-001',
            'customer_id' => 1, // Ahmad Rizki
            'device_id' => 1, // TV Samsung
            'technician_id' => 1, // Budi Santoso
            'keluhan' => 'TV tidak menyala sama sekali, lampu indikator mati',
            'diagnosa' => 'Kapasitor power supply bocor',
            'tindakan' => 'Ganti kapasitor 100uF x3',
            'tanggal_masuk' => '2024-10-01',
            'tanggal_mulai' => '2024-10-02',
            'tanggal_selesai' => '2024-10-03',
            'estimasi_biaya' => 150000,
            'biaya_jasa' => 100000,
            'biaya_sparepart' => 30000,
            'biaya_total' => 130000,
            'status' => 'selesai',
            'prioritas' => 'normal',
        ]);

        Service::create([
            'kode_servis' => 'SRV-002',
            'customer_id' => 2, // Siti Nurhaliza
            'device_id' => 3, // Laptop Asus
            'technician_id' => 2, // Andi Wijaya
            'keluhan' => 'Laptop sangat lemot dan sering overheat',
            'diagnosa' => 'RAM kurang, thermal paste kering',
            'tindakan' => 'Upgrade RAM 8GB, ganti thermal paste',
            'tanggal_masuk' => '2024-10-05',
            'tanggal_mulai' => '2024-10-06',
            'estimasi_biaya' => 700000,
            'biaya_jasa' => 100000,
            'biaya_sparepart' => 630000,
            'biaya_total' => 730000,
            'status' => 'proses',
            'prioritas' => 'normal',
        ]);

        Service::create([
            'kode_servis' => 'SRV-003',
            'customer_id' => 3, // Dedi Kurniawan
            'device_id' => 4, // PC Custom
            'technician_id' => 2, // Andi Wijaya
            'keluhan' => 'PC tidak bisa booting, bunyi beep berulang',
            'diagnosa' => 'Hard disk bad sector parah',
            'tindakan' => 'Ganti hard disk 1TB',
            'tanggal_masuk' => '2024-10-08',
            'estimasi_biaya' => 1000000,
            'biaya_jasa' => 100000,
            'biaya_sparepart' => 900000,
            'biaya_total' => 1000000,
            'status' => 'pending',
            'prioritas' => 'urgent',
        ]);

        Service::create([
            'kode_servis' => 'SRV-004',
            'customer_id' => 1, // Ahmad Rizki
            'device_id' => 2, // AC Daikin
            'technician_id' => 1, // Budi Santoso
            'keluhan' => 'AC tidak dingin, hanya angin biasa',
            'diagnosa' => 'Freon habis, kemungkinan ada kebocoran kecil',
            'tindakan' => 'Isi ulang freon R32',
            'tanggal_masuk' => '2024-10-10',
            'tanggal_mulai' => '2024-10-11',
            'tanggal_selesai' => '2024-10-11',
            'estimasi_biaya' => 450000,
            'biaya_jasa' => 100000,
            'biaya_sparepart' => 350000,
            'biaya_total' => 450000,
            'status' => 'selesai',
            'prioritas' => 'normal',
        ]);

        Service::create([
            'kode_servis' => 'SRV-005',
            'customer_id' => 2, // Siti Nurhaliza
            'device_id' => 5, // Kulkas LG
            'technician_id' => 1, // Budi Santoso
            'keluhan' => 'Kulkas tidak dingin, lampu hidup tapi kompresor mati',
            'diagnosa' => 'Mainboard kulkas rusak',
            'tindakan' => 'Ganti mainboard',
            'tanggal_masuk' => '2024-10-12',
            'estimasi_biaya' => 550000,
            'biaya_jasa' => 100000,
            'biaya_sparepart' => 450000,
            'biaya_total' => 550000,
            'status' => 'pending',
            'prioritas' => 'normal',
        ]);

        Service::create([
            'kode_servis' => 'SRV-006',
            'customer_id' => 3, // Dedi Kurniawan
            'device_id' => 6, // Laptop Lenovo
            'technician_id' => 2, // Andi Wijaya
            'keluhan' => 'Layar laptop bergaris vertikal warna merah',
            'diagnosa' => 'LCD panel rusak',
            'tindakan' => 'Ganti LCD panel 14 inch',
            'tanggal_masuk' => '2024-10-15',
            'tanggal_mulai' => '2024-10-16',
            'estimasi_biaya' => 900000,
            'biaya_jasa' => 100000,
            'biaya_sparepart' => 800000,
            'biaya_total' => 900000,
            'status' => 'proses',
            'prioritas' => 'urgent',
        ]);
            Service::create([
        'kode_servis' => 'SRV-007',
        'customer_id' => 2, // Siti Nurhaliza
        'device_id' => 3, // Laptop Asus
        'technician_id' => 2,
        'keluhan' => 'Laptop tidak bisa masuk Windows, stuck di logo',
        'diagnosa' => 'Hard disk error, perlu diganti',
        'tindakan' => 'Ganti hard disk + install ulang Windows',
        'tanggal_masuk' => '2024-11-01',
        'tanggal_mulai' => '2024-11-02',
        'tanggal_selesai' => '2024-11-03',
        'estimasi_biaya' => 1200000,
        'biaya_jasa' => 200000,
        'biaya_sparepart' => 900000,
        'biaya_total' => 1100000,
        'status' => 'selesai', // SELESAI TAPI BELUM BAYAR
        'prioritas' => 'urgent',
]);

        Service::create([
            'kode_servis' => 'SRV-008',
            'customer_id' => 3, // Dedi Kurniawan
            'device_id' => 6, // Laptop Lenovo
            'technician_id' => 2,
            'keluhan' => 'Baterai laptop cepat habis',
            'diagnosa' => 'Baterai sudah drop, perlu diganti',
            'tindakan' => 'Ganti baterai original',
            'tanggal_masuk' => '2024-11-05',
            'tanggal_mulai' => '2024-11-06',
            'tanggal_selesai' => '2024-11-07',
            'estimasi_biaya' => 800000,
            'biaya_jasa' => 100000,
            'biaya_sparepart' => 700000,
            'biaya_total' => 800000,
            'status' => 'selesai', // SELESAI TAPI BELUM BAYAR
            'prioritas' => 'normal',
        ]);
    }
}