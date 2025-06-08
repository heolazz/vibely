<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeMoodTypeToStringInMoodSongsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mood_songs', function (Blueprint $table) {
            // Change the column type from enum to string
            // We use change() to modify an existing column
            $table->string('mood_type')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mood_songs', function (Blueprint $table) {
            // Revert the column type back to enum if rolling back
            // You must specify the enum values here
            $table->enum('mood_type', ['Positif', 'Negatif', 'Campuran', 'Netral'])->change();
        });
    }
}