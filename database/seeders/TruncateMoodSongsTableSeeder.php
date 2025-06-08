<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MoodSong; // Pastikan model MoodSong diimpor

class TruncateMoodSongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus semua data dari tabel mood_songs
        MoodSong::truncate();

        $this->command->info('Semua data dari tabel mood_songs telah dihapus!');
    }
}