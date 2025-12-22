<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'customer_id',
        'jumlah_bayar',
        'bukti_transfer',
        'metode_pembayaran',
        'status',
        'keterangan',
        'tanggal_upload',
        'tanggal_verifikasi',
        'verified_by',
    ];

    protected $casts = [
        'jumlah_bayar' => 'decimal:2',
        'tanggal_upload' => 'datetime',
        'tanggal_verifikasi' => 'datetime',
    ];

    // Relasi: Payment punya 1 Service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Relasi: Payment punya 1 Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relasi: Payment diverifikasi oleh 1 User (Admin)
    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}