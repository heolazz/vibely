<?php

namespace App\Http\Controllers;

use App\Models\MoodSong;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator; // Import ini!
use Illuminate\Support\Collection; // Import ini!

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
            // 'cenderung-positif' => 'Cenderung Positif', // Pastikan ini dihapus jika tidak digunakan di DB
            // 'cenderung-negatif' => 'Cenderung Negatif', // Pastikan ini dihapus jika tidak digunakan di DB
            'emosi-rekomendasi' => 'Emosi Rekomendasi',
            'senang' => 'Senang',
            'sedih' => 'Sedih',
            'marah' => 'Marah',
            'cemas' => 'Cemas',
        ];

        $dbCategoryToFilter = null;

        if ($selectedSlug && $selectedSlug !== 'semua') {
            if (array_key_exists($selectedSlug, $categorySlugToDbNameMap)) {
                $dbCategoryToFilter = $categorySlugToDbNameMap[$selectedSlug];
            } else {
                $dbCategoryToFilter = Str::headline(str_replace('-', ' ', $selectedSlug));
            }
        }

        // --- Langkah 1: Ambil semua data yang relevan sebelum paginasi ---
        $moodSongs = MoodSong::all()->map(function($song) {
            $song->category_type = 'Mood Rekomendasi';
            $song->category_value = $song->mood_type;
            $song->display_title = $song->title;
            $song->display_artist = $song->artist;
            $song->display_url = $song->url;
            $song->display_cover = $song->album_cover;
            return $song;
        });

        $emotionSongs = Song::all()->map(function($song) {
            $song->category_type = 'Emosi Rekomendasi';
            $song->category_value = $song->emotion;
            $song->display_title = $song->judul; // judul dari model Song
            $song->display_artist = $song->artist; // artist dari model Song
            $song->display_url = $song->link; // link dari model Song
            $song->display_cover = $song->album_cover; // album_cover dari model Song
            return $song;
        });

        $allSongs = $moodSongs->merge($emotionSongs);

        // Lakukan filtering berdasarkan $dbCategoryToFilter pada KOLEKSI ini
        if ($dbCategoryToFilter) {
            $allSongs = $allSongs->filter(function ($song) use ($dbCategoryToFilter) {
                return $song->category_type === $dbCategoryToFilter || $song->category_value === $dbCategoryToFilter;
            });
        }

        // --- Langkah 2: Lakukan Paginasi pada Koleksi ---
        $perPage = 12; // Jumlah item per halaman
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $allSongs->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginatedSongs = new LengthAwarePaginator(
            $currentItems,
            $allSongs->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        // Penting: Gunakan appends() untuk mempertahankan parameter filter kategori
        $paginatedSongs->appends(request()->query());


        // Teruskan $selectedSlug ke view agar tombol yang aktif bisa di-highlight
        return view('music_recommendations.index', compact('allSongs', 'selectedSlug', 'paginatedSongs'));
    }
}