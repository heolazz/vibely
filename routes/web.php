<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\PanasController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;

// Halaman utama

Route::get('/welcome', [ArticleController::class, 'index'])->name('welcome');

// Route::get('/welcome', function () {
//     return view('welcome');
// })->name('welcome');

Route::middleware(['auth'])->group(function () {
    // Rute untuk rekomendasi
    Route::get('/rekomendasi', [RekomendasiController::class, 'index'])->name('rekomendasi');
    Route::post('/rekomendasi', [RekomendasiController::class, 'filter']);

    // Rute PANAS
    Route::get('/panas', [PANASController::class, 'show'])->name('panas.show');
    Route::post('/panas', [PANASController::class, 'store'])->name('panas.store');
    Route::get('/panas/result', function () {
        return view('panas.result');
    })->name('panas.result');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
});


// Rute untuk rekomendasi
// Route::get('/rekomendasi', [RekomendasiController::class, 'index'])->name('rekomendasi');
// Route::post('/rekomendasi', [RekomendasiController::class, 'filter']);

// Group rute dengan middleware autentikasi dan verifikasi
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

// Rute Admin
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {

    // Halaman dashboard admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// USER
    // Halaman daftar user
    Route::get('/users', [AdminController::class, 'showUsers'])->name('admin.users.index');

    // Halaman tambah user
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');

    // Halaman edit user
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');

    // Hapus user
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');


// ARTIKEL KONTEN
    // Halaman daftar artikel di admin
    Route::get('/articles', [AdminController::class, 'showArticles'])->name('admin.articles.index');

    // Halaman edit artikel
    Route::get('/articles/{article}/edit', [AdminController::class, 'editArticle'])->name('admin.articles.edit');

    // Update artikel
    Route::put('/articles/{article}', [AdminController::class, 'updateArticle'])->name('admin.articles.update');

    // Halaman tambah artikel
    Route::get('/articles/create', [AdminController::class, 'createArticle'])->name('admin.articles.create');

    // Simpan artikel baru
    Route::post('/articles', [AdminController::class, 'storeArticle'])->name('admin.articles.store');

    // Hapus artikel
    Route::delete('/articles/{article}', [AdminController::class, 'destroyArticle'])->name('admin.articles.destroy');

// LAGU

    // Daftar lagu
    Route::get('/songs', [AdminController::class, 'showSongs'])->name('admin.songs.index');

    // Form tambah lagu
    Route::get('/songs/create', [AdminController::class, 'createSong'])->name('admin.songs.create');
    Route::post('/songs', [AdminController::class, 'storeSong'])->name('admin.songs.store');

    // Form edit lagu
    Route::get('/songs/{song}/edit', [AdminController::class, 'editSong'])->name('admin.songs.edit');
    Route::put('/songs/{song}', [AdminController::class, 'updateSong'])->name('admin.songs.update');

    // Hapus lagu
    Route::delete('/songs/{song}', [AdminController::class, 'destroySong'])->name('admin.songs.destroy');

});

// Rute untuk menghapus emotion
Route::delete('/emotion/{id}', [RekomendasiController::class, 'destroyEmotion'])->name('emotion.destroy');



Route::get('/panas/history', [PANASController::class, 'history'])->name('panas.history');

Route::get('/', [ArticleController::class, 'index']);

// Bisa diakses oleh siapapun
// Route::get('/artikel/{id}', [ArticleController::class, 'show'])->name('artikel.show');

Route::get('/artikel', [ArticleController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{article}', [ArticleController::class, 'show'])->name('artikel.show');
