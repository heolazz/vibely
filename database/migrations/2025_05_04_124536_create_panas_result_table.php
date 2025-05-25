<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('panas_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('pa_score'); // Positive Affect total
            $table->integer('na_score'); // Negative Affect total
            $table->string('mood_type'); // Positif, Negatif, Campuran, Netral
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('panas_results');
    }
};
