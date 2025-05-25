<?php 
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Song;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Song::insert([
            // Positif
            ['judul' => 'Happy', 'artist' => 'Pharrell Williams', 'link' => 'https://www.youtube.com/watch?v=ZbZSe6N_BXs', 'mood' => 'positif', 'emotion' => 'senang'],
            ['judul' => 'Good Life', 'artist' => 'OneRepublic', 'link' => 'https://www.youtube.com/watch?v=Yj3a1gXKQwI', 'mood' => 'positif', 'emotion' => 'semangat'],
            ['judul' => 'Uptown Funk', 'artist' => 'Mark Ronson ft. Bruno Mars', 'link' => 'https://www.youtube.com/watch?v=OPf0YbXqDm0', 'mood' => 'positif', 'emotion' => 'semangat'],
            ['judul' => 'Can’t Stop the Feeling!', 'artist' => 'Justin Timberlake', 'link' => 'https://www.youtube.com/watch?v=ru0K8uYEZWw', 'mood' => 'positif', 'emotion' => 'senang'],
            
            // Negatif
            ['judul' => 'Someone Like You', 'artist' => 'Adele', 'link' => 'https://www.youtube.com/watch?v=hLQl3WQQoQ0', 'mood' => 'negatif', 'emotion' => 'sedih'],
            ['judul' => 'The Night We Met', 'artist' => 'Lord Huron', 'link' => 'https://www.youtube.com/watch?v=NtFqfHjehF0', 'mood' => 'negatif', 'emotion' => 'sedih'],
            ['judul' => 'Tears Dry on Their Own', 'artist' => 'Amy Winehouse', 'link' => 'https://www.youtube.com/watch?v=98cB2H2EK5w', 'mood' => 'negatif', 'emotion' => 'sedih'],
            ['judul' => 'How to Save a Life', 'artist' => 'The Fray', 'link' => 'https://www.youtube.com/watch?v=cjVQ36NhbMk', 'mood' => 'negatif', 'emotion' => 'sedih'],
            
            // Marah
            ['judul' => 'Believer', 'artist' => 'Imagine Dragons', 'link' => 'https://www.youtube.com/watch?v=7wtfhZwyrcc', 'mood' => 'negatif', 'emotion' => 'marah'],
            ['judul' => 'Lose Yourself', 'artist' => 'Eminem', 'link' => 'https://www.youtube.com/watch?v=_Yhyp-_hX2s', 'mood' => 'negatif', 'emotion' => 'marah'],
            ['judul' => 'We Will Rock You', 'artist' => 'Queen', 'link' => 'https://www.youtube.com/watch?v=-tJYNnB4WvI', 'mood' => 'negatif', 'emotion' => 'marah'],
            ['judul' => 'Numb', 'artist' => 'Linkin Park', 'link' => 'https://www.youtube.com/watch?v=kXYiU_JCYtU', 'mood' => 'negatif', 'emotion' => 'marah'],
            
            // Tenang
            ['judul' => 'Weightless', 'artist' => 'Marconi Union', 'link' => 'https://www.youtube.com/watch?v=UfcAVejslrU', 'mood' => 'tenang', 'emotion' => 'tenang'],
            ['judul' => 'Sunset Lover', 'artist' => 'Petit Biscuit', 'link' => 'https://www.youtube.com/watch?v=chRNhLax3x0', 'mood' => 'tenang', 'emotion' => 'tenang'],
            ['judul' => 'River Flows in You', 'artist' => 'Yiruma', 'link' => 'https://www.youtube.com/watch?v=7maJOI3QMu0', 'mood' => 'tenang', 'emotion' => 'tenang'],
            ['judul' => 'Weightless', 'artist' => 'Marconi Union', 'link' => 'https://www.youtube.com/watch?v=UfcAVejslrU', 'mood' => 'tenang', 'emotion' => 'tenang'],
            
            // Semangat
            ['judul' => 'Stronger', 'artist' => 'Kanye West', 'link' => 'https://www.youtube.com/watch?v=PsO6ZnUZI0g', 'mood' => 'positif', 'emotion' => 'semangat'],
            ['judul' => 'Eye of the Tiger', 'artist' => 'Survivor', 'link' => 'https://www.youtube.com/watch?v=btPJPFnesV4', 'mood' => 'positif', 'emotion' => 'semangat'],
            ['judul' => 'Firework', 'artist' => 'Katy Perry', 'link' => 'https://www.youtube.com/watch?v=QGJuMBdaqIw', 'mood' => 'positif', 'emotion' => 'semangat'],
            ['judul' => 'Don’t Stop Believin’', 'artist' => 'Journey', 'link' => 'https://www.youtube.com/watch?v=1k8craCGpgs', 'mood' => 'positif', 'emotion' => 'semangat'],
        ]);
    }
}
