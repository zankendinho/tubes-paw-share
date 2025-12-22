<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'spare_part_id',
        'qty',
        'harga_satuan',
        'subtotal',
    ];

    protected $casts = [
        'harga_satuan' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    // Relasi: ServiceDetail punya 1 Service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Relasi: ServiceDetail punya 1 SparePart
    public function sparePart()
    {
        return $this->belongsTo(SparePart::class);
    }
}