<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'kategori',
        'merk',
        'model',
        'serial_number',
        'tahun_beli',
        'kondisi',
        'foto',
    ];

    // Relasi: Device punya 1 Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relasi: Device punya banyak Services
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}