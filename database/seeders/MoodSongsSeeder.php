<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MoodSong;

class MoodSongsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan beberapa data contoh untuk mood songs
        MoodSong::create([
            'title' => 'Happy Song',
            'artist' => 'Artist A',
            'mood_type' => 'Positif',
            'url' => 'http://example.com/happy-song',
        ]);

        MoodSong::create([
            'title' => 'Sad Song',
            'artist' => 'Artist B',
            'mood_type' => 'Negatif',
            'url' => 'http://example.com/sad-song',
        ]);

        MoodSong::create([
            'title' => 'Mixed Feelings',
            'artist' => 'Artist C',
            'mood_type' => 'Campuran',
            'url' => 'http://example.com/mixed-feelings',
        ]);

        MoodSong::create([
            'title' => 'Calm Song',
            'artist' => 'Artist D',
            'mood_type' => 'Netral',
            'url' => 'http://example.com/calm-song',
        ]);
    }
}
