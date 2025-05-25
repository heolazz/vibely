<?php

namespace App\Http\Controllers;

use App\Models\MoodSong;

class MoodSongController extends Controller
{
    public function recommend($moodType)
    {
        // Ambil lagu berdasarkan mood yang diberikan
        $songs = MoodSong::where('mood_type', $moodType)->get();

        // Menampilkan halaman rekomendasi musik berdasarkan mood
        return view('mood_songs.recommendations', compact('songs', 'moodType'));
    }
}
