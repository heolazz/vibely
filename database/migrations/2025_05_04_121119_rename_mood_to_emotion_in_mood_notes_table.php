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
        // Mengubah kolom 'mood' menjadi 'emotion' pada tabel mood_notes
        Schema::table('mood_notes', function (Blueprint $table) {
            $table->renameColumn('mood', 'emotion');  // Rename kolom
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Membalikkan perubahan dengan mengubah 'emotion' kembali menjadi 'mood'
        Schema::table('mood_notes', function (Blueprint $table) {
            $table->renameColumn('emotion', 'mood');
        });
    }
};
