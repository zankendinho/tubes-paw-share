<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        // Payment untuk service yang sudah selesai (SRV-001 & SRV-004)
        Payment::create([
            'service_id' => 1, // SRV-001
            'customer_id' => 1,
            'jumlah_bayar' => 130000,
            'bukti_transfer' => 'bukti-srv001.jpg',
            'metode_pembayaran' => 'transfer_bank',
            'status' => 'verified',
            'keterangan' => 'Pembayaran via BCA',
            'tanggal_upload' => '2024-10-03 10:00:00',
            'tanggal_verifikasi' => '2024-10-03 11:00:00',
            'verified_by' => 1, // Admin
        ]);

        Payment::create([
            'service_id' => 4, // SRV-004
            'customer_id' => 1,
            'jumlah_bayar' => 450000,
            'bukti_transfer' => 'bukti-srv004.jpg',
            'metode_pembayaran' => 'transfer_bank',
            'status' => 'verified',
            'keterangan' => 'Pembayaran via Mandiri',
            'tanggal_upload' => '2024-10-11 14:00:00',
            'tanggal_verifikasi' => '2024-10-11 15:00:00',
            'verified_by' => 1,
        ]);
    }
}