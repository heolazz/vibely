<?php

namespace App\Http\Controllers;

use App\Models\MoodSong;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection; // Pastikan ini di-use

class MusicRecommendationController extends Controller
{
    public function index(Request $request)
    {
        // 1. Autentikasi Pengguna
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Anda harus login untuk melihat halaman rekomendasi musik.');
        }

        $selectedSlug = $request->input('category'); // Mengambil slug kategori dari URL

        // 2. Pemetaan Slug ke Nama Kategori di Database (Case-Insensitive di Filter)
        $categorySlugToDbNameMap = [
            'mood-rekomendasi' => 'Mood Rekomendasi', // Kategori utama Mood
            'positif' => 'Positif',
            'negatif' => 'Negatif',
            'netral' => 'Netral',
            'campuran' => 'Campuran',
            'emosi-rekomendasi' => 'Emosi Rekomendasi', // Kategori utama Emosi
            'senang' => 'Senang',
            'sedih' => 'Sedih',
            'marah' => 'Marah',
            'cemas' => 'Cemas',
            'semangat' => 'Semangat', // Tambahkan jika ada di DB dan filter
            'tenang' => 'Tenang',     // Tambahkan jika ada di DB dan filter
        ];

        $dbCategoryToFilter = null;

        if ($selectedSlug && $selectedSlug !== 'semua') {
            if (array_key_exists($selectedSlug, $categorySlugToDbNameMap)) {
                // Jika slug ada di map, gunakan nama DB yang sudah ditentukan
                $dbCategoryToFilter = $categorySlugToDbNameMap[$selectedSlug];
            } else {
                // Fallback: Jika slug tidak ada di map, coba konversi dari slug
                // Contoh: 'semangat' -> 'Semangat'
                $dbCategoryToFilter = Str::headline(str_replace('-', ' ', $selectedSlug));
            }
        }

        // 3. Ambil dan Format Data Lagu (Mood & Emosi)
        // Pastikan model MoodSong memiliki kolom 'album_cover'
        $moodSongs = MoodSong::all()->map(function($song) {
            $song->category_type = 'Mood Rekomendasi'; // Jenis kategori induk
            $song->category_value = $song->mood_type;  // Nilai mood spesifik (Positif, Negatif, dll.)
            $song->display_title = $song->title;
            $song->display_artist = $song->artist;
            $song->display_url = $song->url;
            $song->display_cover = $song->album_cover; // Kolom ini harus ada di tabel mood_songs
            return $song;
        });

        // Pastikan model Song memiliki kolom 'judul', 'artist', 'link', 'emotion'
        // Tabel 'songs' kemungkinan besar tidak memiliki 'album_cover'.
        // Berikan nilai default atau null jika tidak ada cover untuk lagu emosi.
        $emotionSongs = Song::all()->map(function($song) {
            $song->category_type = 'Emosi Rekomendasi'; // Jenis kategori induk
            $song->category_value = $song->emotion;     // Nilai emosi spesifik (Senang, Sedih, dll.)
            $song->display_title = $song->judul; // Asumsi kolom judul
            $song->display_artist = $song->artist;
            $song->display_url = $song->link;
            $song->display_cover = null; // Asumsi tidak ada album_cover di tabel 'songs'. Beri default lain jika ada.
            return $song;
        });

        $allSongs = $moodSongs->merge($emotionSongs); // Gabungkan semua lagu

        // 4. Lakukan Filtering pada Koleksi Gabungan
        if ($dbCategoryToFilter) {
            $lowerCaseDbCategoryToFilter = Str::lower($dbCategoryToFilter);

            $allSongs = $allSongs->filter(function ($song) use ($lowerCaseDbCategoryToFilter) {
                // Periksa apakah category_type (induk) cocok
                $typeMatch = Str::lower($song->category_type) === $lowerCaseDbCategoryToFilter;

                // Periksa apakah category_value (anak) cocok
                $valueMatch = Str::lower($song->category_value) === $lowerCaseDbCategoryToFilter;

                return $typeMatch || $valueMatch;
            });
        }

        // 5. Lakukan Paginasi
        $perPage = 12;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $allSongs->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginatedSongs = new LengthAwarePaginator(
            $currentItems,
            $allSongs->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        $paginatedSongs->appends(request()->query());

        // 6. Kirim ke View
        // Variabel `allSongs` tidak perlu dikirim ke view jika yang dipakai hanya `paginatedSongs`.
        return view('music_recommendations.index', compact('paginatedSongs', 'selectedSlug'));
    }
}