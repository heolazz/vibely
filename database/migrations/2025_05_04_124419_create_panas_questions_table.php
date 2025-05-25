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
        Schema::create('panas_questions', function (Blueprint $table) {
            $table->id();
            $table->string('emotion'); // contoh: excited, nervous
            $table->enum('type', ['positive', 'negative']); // PA atau NA
            $table->text('question_text');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panas_questions');
    }
};
