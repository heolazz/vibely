<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // ... seeder lainnya jika ada ...
            \Database\Seeders\SongSeeder::class,
            \Database\Seeders\MoodSongsSeeder::class,
            \Database\Seeders\AdminUserSeeder::class,
            \Database\Seeders\ArticleSeeder::class,
            \Database\Seeders\PanasQuestionSeeder::class,
        ]);
    }
}