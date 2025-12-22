<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->enum('kategori', ['TV', 'AC', 'Laptop', 'PC', 'Kulkas', 'Mesin Cuci', 'Lainnya']);
            $table->string('merk', 50);
            $table->string('model', 50)->nullable();
            $table->string('serial_number', 100)->nullable();
            $table->year('tahun_beli')->nullable();
            $table->text('kondisi')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};