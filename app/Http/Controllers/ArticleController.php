<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Pastikan ini di-import untuk Str::headline() jika belum

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     * This method will still be used for the 'welcome' page, showing a limited number of articles.
     */
    public function index()
    {
        $articles = Article::latest()->take(6)->get();
        return view('welcome', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This method is likely for admin, but it's empty. Keep as is for now.
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // This method is likely for admin, but it's empty. Keep as is for now.
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('artikel.show', compact('article'));
    }

    /**
     * Display all articles, with optional category filtering.
     * This method will serve the 'artikel.index' route.
     */
    public function allArticles(Request $request) // Tambahkan Request $request
    {
        $query = Article::latest(); // Mulai dengan query dasar

        $selectedCategory = $request->query('category'); // Ambil parameter 'category' dari URL

        // Jika ada parameter 'category' dan tidak kosong
        if ($selectedCategory) {
            // Konversi slug kembali ke format kategori yang disimpan di database
            // Contoh: 'mengenali-emosi' menjadi 'Mengenali Emosi'
            $dbCategoryName = Str::headline(str_replace('-', ' ', $selectedCategory));

            $query->where('category', $dbCategoryName);
        }

        $articles = $query->paginate(9); // Terapkan paginasi

        // Untuk highlight kategori yang dipilih di Blade, teruskan juga selectedCategory
        // Atau Anda bisa menggunakan request('category') langsung di Blade
        return view('artikel.index', compact('articles', 'selectedCategory'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        // This method is likely for admin, but it's empty. Keep as is for now.
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        // This method is likely for admin, but it's empty. Keep as is for now.
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // This method is likely for admin, but it's empty. Keep as is for now.
    }

    // Hapus metode filterByCategory karena logikanya sudah dipindahkan ke allArticles
    // public function filterByCategory(Request $request) { ... }
}