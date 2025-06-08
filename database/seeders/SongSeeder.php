<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Song;

class SongSeeder extends Seeder
{
    public function run()
    {
        $songsData = [
            // 🎉 Senang
            [
                'judul' => 'Way Back Home',
                'artist' => 'Shaun',
                'link' => 'https://open.spotify.com/intl-id/track/1ZLrDPgR7mvuTco3rQK8Pk?si=187203b4b97142f9',
                'emotion' => 'Senang',
            ],
            [
                'judul' => 'Feel Special',
                'artist' => 'TWICE',
                'link' => '<link Spotify>',
                'emotion' => 'Senang',
            ],
            [
                'judul' => 'Dance With Me',
                'artist' => 'Tones And I',
                'link' => 'https://open.spotify.com/intl-id/track/2I5ipWaIXUknimwtJPoPYt?si=0952c12579d146ed',
                'emotion' => 'Senang',
            ],
            [
                'judul' => 'Butter',
                'artist' => 'BTS',
                'link' => 'https://open.spotify.com/intl-id/track/1mWdTewIgB3gtBM3TOSFhB?si=1d1f6a83a8df479b',
                'emotion' => 'Senang',
            ],

            // 😢 Sedih
            [
                'judul' => 'Kataomoi',
                'artist' => 'Aimer',
                'link' => 'https://open.spotify.com/intl-id/track/2HovXsvcdJur52BOcYGydz?si=3e351105e3324074',
                'emotion' => 'Sedih',
            ],
            [
                'judul' => 'Orange',
                'artist' => '7!!',
                'link' => 'https://open.spotify.com/intl-id/track/21htkjP5rYjD3CXG3y9wCT?si=2149cb65e855443b',
                'emotion' => 'Sedih',
            ],
            [
                'judul' => 'Ending Scene',
                'artist' => 'IU',
                'link' => 'https://open.spotify.com/intl-id/track/06EMBzxDm2hueehobAlMtm?si=21fcc86d6dc8485e',
                'emotion' => 'Sedih',
            ],
            [
                'judul' => 'Through the Night',
                'artist' => 'IU',
                'link' => 'https://open.spotify.com/intl-id/track/3P3UA61WRQqwCXaoFOTENd?si=bf431b5575274654',
                'emotion' => 'Sedih',
            ],
            [
                'judul' => 'You Were Beautiful',
                'artist' => 'DAY6',
                'link' => 'https://open.spotify.com/intl-id/track/3FR2yqZsG07NhXz7uPyUyC?si=1e59b51dcaf748c5',
                'emotion' => 'Sedih',
            ],
            [
                'judul' => 'Aerith’s Theme',
                'artist' => 'Final Fantasy VII OST',
                'link' => 'https://open.spotify.com/intl-id/track/2s4wu9Z76eEczUOfAQXMEz?si=3e25861418174945',
                'emotion' => 'Sedih',
            ],
            [
                'judul' => 'Sadness and Sorrow',
                'artist' => 'Naruto OST',
                'link' => 'https://open.spotify.com/intl-id/track/4U2v1vLfpfNjOEXVuY1aHd?si=7dcc320378dc463b',
                'emotion' => 'Sedih',
            ],

            // 😠 Marah
            [
                'judul' => 'Inferno',
                'artist' => 'Mrs. GREEN APPLE',
                'link' => 'https://open.spotify.com/intl-id/track/64yajM6CxtLghmgB53VeXT?si=4e16b28957944bf6',
                'emotion' => 'Marah',
            ],
            [
                'judul' => 'Nxde',
                'artist' => '(G)I-DLE',
                'link' => 'https://open.spotify.com/intl-id/track/7N1X5WzBTCoDh4ocuPlZUC?si=0253aae563bb4546',
                'emotion' => 'Marah',
            ],
            [
                'judul' => 'Megalovania',
                'artist' => 'Undertale OST',
                'link' => 'https://open.spotify.com/intl-id/track/1J03Vp93ybKIxfzYI4YJtL?si=c9c6d531fc3143ef',
                'emotion' => 'Marah',
            ],
            [
                'judul' => 'One Step Closer',
                'artist' => 'Linkin Park',
                'link' => 'https://open.spotify.com/intl-id/track/3K4HG9evC7dg3N0R9cYqk4?si=df26c961726b4caf',
                'emotion' => 'Marah',
            ],
            [
                'judul' => 'Psychosocial',
                'artist' => 'Slipknot',
                'link' => 'https://open.spotify.com/intl-id/track/3RAFcUBrCNaboRXoP3S5t1?si=dd997a2e60b94771',
                'emotion' => 'Marah',
            ],

            // 😰 Cemas
            [
                'judul' => 'Weightless',
                'artist' => 'Marconi Union',
                'link' => 'https://open.spotify.com/intl-id/track/6kkwzB6hXLIONkEk9JciA6?si=88e2d3bd7d634645',
                'emotion' => 'Cemas',
            ],

            // ❤️ Cinta
            [
                'judul' => 'Love Poem',
                'artist' => 'IU',
                'link' => 'https://open.spotify.com/intl-id/track/7HrE6HtYNBbGqp5GmHbFV0?si=5c2a193e2ec04c25',
                'emotion' => 'Cinta',
            ],
            [
                'judul' => 'Some',
                'artist' => 'Soyou & Junggigo',
                'link' => 'https://open.spotify.com/intl-id/track/0g1AmSKokPboFrxmG1dxKx?si=a29275733fb944da',
                'emotion' => 'Cinta',
            ],
            [
                'judul' => 'All For You',
                'artist' => 'Seo In Guk & Jung Eunji',
                'link' => '<link Spotify>',
                'emotion' => 'Cinta',
            ],
            [
                'judul' => 'Clair de Lune',
                'artist' => 'Debussy',
                'link' => 'https://open.spotify.com/intl-id/track/6Er8Fz6fuZNi5cvwQjv1ya?si=24f023beb1cf4eca',
                'emotion' => 'Cinta',
            ],
            [
                'judul' => 'Some',
                'artist' => 'Bol4',
                'link' => 'https://open.spotify.com/intl-id/track/3jsYQw78lrxJA2ysnmOIf9?si=03bd27bbcf32480c',
                'emotion' => 'Cinta',
            ],

            // 🕊️ Tenang
            [
                'judul' => 'A Place to Call Home',
                'artist' => 'Evan to Call',
                'link' => 'https://open.spotify.com/intl-id/track/0OmeiHteLXYx4nxVaxWydn?si=d853c2afee6f42e9',
                'emotion' => 'Tenang',
            ],
            [
                'judul' => 'Always with Me',
                'artist' => 'Joe Hisaishi',
                'link' => 'https://open.spotify.com/intl-id/track/0FJL3Dwu8oUpwDb80qNdvP?si=de97420397b14e45',
                'emotion' => 'Tenang',
            ],
            [
                'judul' => 'Gymnopédie No.1',
                'artist' => 'Erik Satie',
                'link' => 'https://open.spotify.com/intl-id/track/5NGtFXVpXSvwunEIGeviY3?si=1540cb07d1ab4440',
                'emotion' => 'Tenang',
            ],
        ];

        foreach ($songsData as $song) {
            Song::create($song);
        }
    }
}
