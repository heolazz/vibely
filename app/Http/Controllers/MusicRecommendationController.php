<?php

namespace App\Http\Controllers;

use App\Models\MoodSong;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class MusicRecommendationController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Anda harus login untuk melihat halaman rekomendasi musik.');
        }

        $selectedSlug = $request->input('category');

        $categorySlugToDbNameMap = [
            'mood-rekomendasi' => 'Mood Rekomendasi',
            'positif' => 'Positif',
            'negatif' => 'Negatif',
            'netral' => 'Netral',
            'campuran' => 'Campuran',
            'emosi-rekomendasi' => 'Emosi Rekomendasi',
            'senang' => 'Senang', // Pastikan mapping ini mencerminkan yang ada di DB, atau biarkan Str::headline yang menanganinya
            'sedih' => 'Sedih',
            'marah' => 'Marah',
            'cemas' => 'Cemas',
            'semangat' => 'Semangat', // Tambahkan jika ada slug untuk ini
            'tenang' => 'Tenang',     // Tambahkan jika ada slug untuk ini
        ];

        $dbCategoryToFilter = null;

        if ($selectedSlug && $selectedSlug !== 'semua') {
            if (array_key_exists($selectedSlug, $categorySlugToDbNameMap)) {
                $dbCategoryToFilter = $categorySlugToDbNameMap[$selectedSlug];
            } else {
                // Ini akan mengubah "senang" menjadi "Senang"
                $dbCategoryToFilter = Str::headline(str_replace('-', ' ', $selectedSlug));
            }
        }

        // --- Langkah 1: Ambil semua data yang relevan sebelum paginasi ---
        $moodSongs = MoodSong::all()->map(function($song) {
            $song->category_type = 'Mood Rekomendasi';
            $song->category_value = $song->mood_type; // Mood type harusnya sudah sesuai case di DB
            $song->display_title = $song->title;
            $song->display_artist = $song->artist;
            $song->display_url = $song->url;
            $song->display_cover = $song->album_cover;
            return $song;
        });

        $emotionSongs = Song::all()->map(function($song) {
            $song->category_type = 'Emosi Rekomendasi';
            $song->category_value = $song->emotion; // Ini nilai emotion dari DB
            $song->display_title = $song->judul;
            $song->display_artist = $song->artist;
            $song->display_url = $song->link;
            $song->display_cover = $song->album_cover; // Sesuaikan jika ini dari MoodSong saja
            return $song;
        });

        $allSongs = $moodSongs->merge($emotionSongs);

        // Lakukan filtering berdasarkan $dbCategoryToFilter pada KOLEKSI ini
        if ($dbCategoryToFilter) {
            // Konversi nilai filter dan nilai dari koleksi ke huruf kecil untuk perbandingan
            $lowerCaseDbCategoryToFilter = Str::lower($dbCategoryToFilter);

            $allSongs = $allSongs->filter(function ($song) use ($lowerCaseDbCategoryToFilter) {
                // Bandingkan category_type (misal 'Mood Rekomendasi') atau category_value (misal 'senang')
                // Pastikan kedua sisi perbandingan dikonversi ke lowercase
                return Str::lower($song->category_type) === $lowerCaseDbCategoryToFilter || Str::lower($song->category_value) === $lowerCaseDbCategoryToFilter;
            });
        }

        // --- Langkah 2: Lakukan Paginasi pada Koleksi ---
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

        return view('music_recommendations.index', compact('allSongs', 'selectedSlug', 'paginatedSongs'));
    }
}