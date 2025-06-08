<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class TruncateArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        article::truncate();

        $this->command->info('Semua data dari tabel artikel telah dihapus!');
    }
}