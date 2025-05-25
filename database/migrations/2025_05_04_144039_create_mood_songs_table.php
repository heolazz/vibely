<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoodSongsTable extends Migration
{
    public function up()
    {
        Schema::create('mood_songs', function (Blueprint $table) {
            $table->id();
            $table->string('title');  // Judul lagu
            $table->string('artist'); // Artis
            $table->enum('mood_type', ['Positif', 'Negatif', 'Campuran', 'Netral']);  // Tipe mood yang sesuai
            $table->string('url');  // URL lagu
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mood_songs');
    }
}
