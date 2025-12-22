<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'telp',
        'alamat',
        'tanggal_daftar',
    ];

    protected $casts = [
        'tanggal_daftar' => 'date',
    ];

    // Relasi: Customer punya 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Customer punya banyak Devices
    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    // Relasi: Customer punya banyak Services
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}