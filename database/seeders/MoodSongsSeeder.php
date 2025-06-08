<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MoodSong; // Pastikan model MoodSong sudah ada

class MoodSongsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Menambahkan data contoh untuk mood songs sesuai permintaan
        MoodSong::create([
            'title' => 'Happy Morning Jazz',
            'artist' => 'Relaxing Land',
            'mood_type' => 'Positif',
            'url' => 'https://youtu.be/83suG7R6hQw?si=Jidl3Evo9OwpU8T_',
        ]);

        MoodSong::create([
            'title' => 'Poem of the Moon',
            'artist' => 'Big Rice Piano', // Perbaiki 'Big rice Piano' menjadi 'Big Rice Piano'
            'mood_type' => 'Negatif',
            'url' => 'https://youtu.be/Zu_pBbCwovA?si=CMPUIRNRvmuWJ2N9',
            
        ]);

        // Lagu kedua untuk mood Negatif
        MoodSong::create([
            'title' => 'Mood Booster Playlist', // Judul ini mungkin ironis untuk mood Negatif, tapi saya akan mengikuti permintaan.
            'artist' => 'Just Chillin',
            'mood_type' => 'Negatif',
            'url' => 'https://youtu.be/ljnGl5nvUJY?si=CWRBLw36oDZXq44o',
           
        ]);

        MoodSong::create([
            'title' => 'Ghibli Jazz Bossa Nova', // Perbaiki 'Ghibli jazz Bossa Nova' menjadi 'Ghibli Jazz Bossa Nova'
            'artist' => 'Studio Ghibli',
            'mood_type' => 'Netral',
            'url' => 'https://youtu.be/3jWRrafhO7M?si=0G9xnIJOESHS_ll4',
            
        ]);

        MoodSong::create([
            'title' => 'Swing Jazz Playlist',
            'artist' => 'Wooden Chair',
            'mood_type' => 'Campuran', // Perbaiki 'moo type' menjadi 'mood_type'
            'url' => 'https://youtu.be/mZ4cGYbcJPc?si=EHUIgZkEg1Sp4ja2',
           
        ]);
    }
}