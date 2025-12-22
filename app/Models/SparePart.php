<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_part',
        'nama_part',
        'kategori',
        'stok',
        'stok_minimum',
        'harga_beli',
        'harga_jual',
        'supplier',
        'keterangan',
        'foto',
    ];

    protected $casts = [
        'harga_beli' => 'decimal:2',
        'harga_jual' => 'decimal:2',
    ];

    // Relasi: SparePart punya banyak ServiceDetails
    public function serviceDetails()
    {
        return $this->hasMany(ServiceDetail::class);
    }
}