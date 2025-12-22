<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_servis',
        'customer_id',
        'device_id',
        'technician_id',
        'keluhan',
        'diagnosa',
        'tindakan',
        'tanggal_masuk',
        'tanggal_mulai',
        'tanggal_estimasi_selesai',
        'tanggal_selesai',
        'estimasi_biaya',
        'biaya_jasa',
        'biaya_sparepart',
        'biaya_total',
        'status',
        'prioritas',
        'catatan',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'tanggal_mulai' => 'date',
        'tanggal_estimasi_selesai' => 'date',
        'tanggal_selesai' => 'date',
        'estimasi_biaya' => 'decimal:2',
        'biaya_jasa' => 'decimal:2',
        'biaya_sparepart' => 'decimal:2',
        'biaya_total' => 'decimal:2',
    ];

    // Relasi: Service punya 1 Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    // Relasi: Service punya 1 Payment
    public function payment()
    {
    return $this->hasOne(Payment::class);
    }
    // Relasi: Service punya 1 Device
    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    // Relasi: Service punya 1 Technician
    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }

    // Relasi: Service punya banyak ServiceDetails
    public function serviceDetails()
    {
        return $this->hasMany(ServiceDetail::class);
    }
}