<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class UserController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->take(6)->get();
        return view('dashboard', compact('articles'));
    }

    
// Menampilkan artikel berdasarkan kategori
public function filterArticlesByCategory(Request $request)
{
    $category = $request->input('category');

    if ($category && $category !== 'Semua') {
        $articles = Article::where('category', $category)->latest()->paginate(10);
    } else {
        $articles = Article::latest()->paginate(10);
    }

    return view('admin.articles.index', compact('articles', 'category'));
}

}


