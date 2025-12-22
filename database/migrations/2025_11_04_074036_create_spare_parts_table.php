<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spare_parts', function (Blueprint $table) {
            $table->id();
            $table->string('kode_part', 50)->unique();
            $table->string('nama_part', 100);
            $table->string('kategori', 50)->nullable();
            $table->integer('stok')->default(0);
            $table->integer('stok_minimum')->default(5);
            $table->decimal('harga_beli', 10, 2)->nullable();
            $table->decimal('harga_jual', 10, 2)->nullable();
            $table->string('supplier', 100)->nullable();
            $table->text('keterangan')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spare_parts');
    }
};