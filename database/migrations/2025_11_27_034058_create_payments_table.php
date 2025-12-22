<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->decimal('jumlah_bayar', 10, 2);
            $table->string('bukti_transfer')->nullable(); // nama file bukti transfer
            $table->enum('metode_pembayaran', ['transfer_bank', 'cash', 'e-wallet'])->default('transfer_bank');
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->text('keterangan')->nullable();
            $table->timestamp('tanggal_upload')->nullable();
            $table->timestamp('tanggal_verifikasi')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};