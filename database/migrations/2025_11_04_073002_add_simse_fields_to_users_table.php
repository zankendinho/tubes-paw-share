<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom 'name' bawaan Laravel, ganti dengan 'nama'
            $table->dropColumn('name');
            
            // Tambah kolom untuk SIMSE
            $table->string('nama', 100)->after('id');
            $table->string('username', 50)->unique()->after('nama');
            $table->enum('role', ['admin', 'customer'])->default('customer')->after('email');
            $table->string('telp', 15)->nullable()->after('role');
            $table->string('foto')->default('default.jpg')->after('telp');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif')->after('foto');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nama', 'username', 'role', 'telp', 'foto', 'status']);
            $table->string('name')->after('id');
        });
    }
};