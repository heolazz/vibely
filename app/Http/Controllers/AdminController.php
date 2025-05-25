<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Song;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // Halaman dashboard admin
    public function index()
    {
        // Menghitung jumlah pengguna,musik, dan artikel
        $totalUsers = User::count();
        $totalSongs = Song::count();
        $totalArticles = Article::count();
        $articles = Article::latest()->take(5)->get();
        // Kirimkan data jumlah pengguna ke view
        return view('admin.dashboard', compact('totalUsers', 'totalSongs', 'totalArticles', 'articles'));
    }

    // Menampilkan semua user
    public function showUsers()
    {
        $users = User::all();  // Ambil semua user
        return view('admin.users.index', compact('users'));
    }

    // Menambah user baru
    public function createUser()
    {
        return view('admin.users.create');
    }

    // Simpan user baru
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user',  // Role default adalah user
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan!');
    }

    // Mengedit user
    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update data user
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui!');
    }

    // Hapus user
    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
    }

      // Tampilkan daftar artikel dengan pagination
      public function showArticles()
      {
          $articles = Article::latest()->paginate(10);
          return view('admin.articles.index', compact('articles'));
      }
  
      // Form tambah artikel baru
      public function createArticle()
      {
          return view('admin.articles.create');
      }
  
      // Simpan artikel baru
public function storeArticle(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    $excerpt = $this->makeExcerpt($request->input('content'));

    Article::create([
        'title' => $request->input('title'),
        'content' => $request->input('content'),
        'excerpt' => $excerpt,
    ]);

    return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan!');
}
  
      // Form edit artikel
      public function editArticle(Article $article)
      {
          return view('admin.articles.edit', compact('article'));
      }
  
      private function makeExcerpt($content, $limit = 100)
{
    return \Str::limit(strip_tags($content), $limit);
}

      // Update artikel
     public function updateArticle(Request $request, Article $article)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    $excerpt = $this->makeExcerpt($request->input('content'));

    $article->update([
        'title' => $request->input('title'),
        'content' => $request->input('content'),
        'excerpt' => $excerpt,
    ]);

    return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui!');
}
  
      // Hapus artikel
      public function destroyArticle(Article $article)
      {
          $article->delete();
  
          return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus!');
      }

      

// Tampilkan daftar lagu
public function showSongs()
{
    $songs = Song::latest()->paginate(10);
    return view('admin.songs.index', compact('songs'));
}

// Form tambah lagu
public function createSong()
{
    return view('admin.songs.create');
}

// Simpan lagu baru
public function storeSong(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'artist' => 'nullable|string|max:255',
        'url' => 'nullable|url', // Contoh kalau ada url streaming
        // tambahkan validasi lain jika perlu
    ]);

    Song::create([
        'judul' => $request->title,
        'artist' => $request->artist,
        'url' => $request->url,
    ]);

    return redirect()->route('admin.songs.index')->with('success', 'Lagu berhasil ditambahkan!');
}

// Form edit lagu
public function editSong(Song $song)
{
    return view('admin.songs.edit', compact('song'));
}

// Update lagu
public function updateSong(Request $request, Song $song)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'artist' => 'nullable|string|max:255',
        'url' => 'nullable|url',
    ]);

    $song->update([
        'judul' => $request->title,
        'artist' => $request->artist,
        'url' => $request->url,
    ]);

    return redirect()->route('admin.songs.index')->with('success', 'Lagu berhasil diperbarui!');
}

// Hapus lagu
public function destroySong(Song $song)
{
    $song->delete();
    return redirect()->route('admin.songs.index')->with('success', 'Lagu berhasil dihapus!');
}



}

