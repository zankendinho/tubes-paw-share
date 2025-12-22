<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('technicians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('spesialisasi', 100)->nullable();
            $table->integer('pengalaman')->default(0);
            $table->decimal('rating', 3, 2)->default(0.00);
            $table->integer('total_servis')->default(0);
            $table->enum('status', ['tersedia', 'sibuk'])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('technicians');
    }
};