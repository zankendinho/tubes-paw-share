<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'spesialisasi',
        'pengalaman',
        'rating',
        'total_servis',
        'status',
    ];

    protected $casts = [
        'rating' => 'decimal:2',
    ];

    // Relasi: Technician punya 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Technician punya banyak Services
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}