<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Menambahkan kolom 'category' setelah kolom 'title'
            // string(): tipe data string (teks pendek)
            // nullable(): kolom ini boleh kosong (tidak wajib diisi)
            // after('title'): kolom akan ditambahkan setelah kolom 'title'
            $table->string('category')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Menghapus kolom 'category' jika migrasi di-rollback
            $table->dropColumn(columns: 'category');
        });
    }
};