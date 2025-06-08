<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Song; 

class TruncateSongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus semua data dari tabel songs
        Song::truncate();

        $this->command->info('Semua data dari tabel songs telah dihapus!');
    }
}