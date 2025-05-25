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
}
