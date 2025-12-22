<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('kode_servis', 20)->unique();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('device_id')->constrained('devices')->onDelete('cascade');
            $table->foreignId('technician_id')->nullable()->constrained('technicians')->onDelete('set null');
            $table->text('keluhan');
            $table->text('diagnosa')->nullable();
            $table->text('tindakan')->nullable();
            $table->date('tanggal_masuk');
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_estimasi_selesai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->decimal('estimasi_biaya', 10, 2)->default(0);
            $table->decimal('biaya_jasa', 10, 2)->default(0);
            $table->decimal('biaya_sparepart', 10, 2)->default(0);
            $table->decimal('biaya_total', 10, 2)->default(0);
            $table->enum('status', ['pending', 'proses', 'selesai', 'diambil', 'batal'])->default('pending');
            $table->enum('prioritas', ['normal', 'urgent'])->default('normal');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};