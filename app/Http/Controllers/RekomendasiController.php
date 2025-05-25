<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\EmotionNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekomendasiController extends Controller
{
    public function index()
    {
        $emotionNotes = EmotionNote::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
    
        $emotion = session('selected_emotion');
    
        $songs = null;
        if ($emotion) {
            $songs = Song::where('emotion', $emotion)->get();
        }
    
        return view('rekomendasi', compact('emotionNotes', 'songs', 'emotion'));
    }
    

    public function filter(Request $request)
{
    $emotion = $request->input('emotion');
    $note = $request->input('note');

    // Simpan emosi & note baru
    EmotionNote::create([
        'user_id' => Auth::id(),
        'emotion' => $emotion,
        'note' => $note,
    ]);

    // Redirect ke halaman rekomendasi dengan parameter emosi (opsional)
    return redirect()->route('rekomendasi')->with('selected_emotion', $emotion);
}


    public function destroyEmotion($id)
    {
        // Cek apakah emotion note milik user yang sedang login
        $note = EmotionNote::where('user_id', Auth::id())->findOrFail($id);

        // Hapus emotion note
        $note->delete();

        // Kembalikan ke halaman rekomendasi dengan pesan sukses
        return redirect()->route('rekomendasi')->with('success', 'Emosi berhasil dihapus!');
    }
}
