<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\EmotionNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Import Carbon untuk manipulasi tanggal

class RekomendasiController extends Controller
{
    /**
     * Menampilkan halaman utama rekomendasi dengan riwayat emosi dan formulir input.
     * Dapat memfilter riwayat berdasarkan jumlah hari.
     */
    public function index(Request $request)
    {
        // Pastikan user terautentikasi sebelum mengambil data
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Anda harus login untuk melihat halaman ini.');
        }

        $userId = Auth::id(); // Ambil ID user yang sedang login

        // Dapatkan filter hari dari request, default ke 0 (semua histori)
        $daysFilter = $request->input('days', 0); // Default ke 0 untuk semua riwayat

        $emotionNotesQuery = EmotionNote::where('user_id', $userId)
            ->orderBy('created_at', 'desc');

        // Terapkan filter tanggal jika daysFilter tidak 0
        if ($daysFilter > 0) {
            $emotionNotesQuery->where('created_at', '>=', Carbon::now()->subDays($daysFilter));
        }

        $emotionNotes = $emotionNotesQuery->get();

        // Menghitung frekuensi emosi untuk grafik
        // Inisialisasi array dengan semua emosi yang mungkin dan hitungan 0
        $allEmotions = [
            'Senang', 'Sedih', 'Marah', 'Cemas'
        ];
        $emotionCounts = array_fill_keys($allEmotions, 0); // Inisialisasi semua dengan 0

        // Isi hitungan berdasarkan data dari database yang sudah difilter
        foreach ($emotionNotes as $note) {
            if (isset($emotionCounts[$note->emotion])) {
                $emotionCounts[$note->emotion]++;
            }
        }

        $emotion = session('selected_emotion');

        $songs = null;
        if ($emotion) {
            $songs = Song::where('emotion', $emotion)->get();
        }

        // Teruskan $emotionCounts dan $daysFilter ke view
        return view('rekomendasi', compact('emotionNotes', 'songs', 'emotion', 'emotionCounts', 'daysFilter'));
    }

    /**
     * Menyimpan catatan emosi baru dan merekomendasikan musik berdasarkan emosi yang dipilih.
     */
    public function filter(Request $request)
    {
        // Pastikan user terautentikasi sebelum menyimpan data
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Anda harus login untuk menyimpan jurnal.');
        }

        $emotion = $request->input('emotion');
        $note = $request->input('note');

        // Simpan emosi & note baru
        EmotionNote::create([
            'user_id' => Auth::id(),
            'emotion' => $emotion,
            'note' => $note,
        ]);

        // Redirect ke halaman rekomendasi dengan parameter emosi yang dipilih
        return redirect()->route('rekomendasi')->with('selected_emotion', $emotion)->with('success', 'Jurnal berhasil disimpan dan musik direkomendasikan!');
    }

    /**
     * Menampilkan detail catatan emosi tertentu dan lagu-lagu yang direkomendasikan.
     *
     * @param int $id ID dari catatan emosi yang akan ditampilkan.
     */
    public function show($id)
    {
        // Pastikan user terautentikasi
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Anda harus login untuk melihat detail jurnal.');
        }

        // Temukan catatan emosi berdasarkan ID dan pastikan itu milik user yang sedang login
        $emotionNote = EmotionNote::where('user_id', Auth::id())->findOrFail($id);

        // Ambil lagu-lagu berdasarkan emosi dari catatan yang dipilih
        $songs = Song::where('emotion', $emotionNote->emotion)->get();

        // Teruskan catatan emosi dan lagu-lagu ke view detail
        return view('emotion_note_detail', compact('emotionNote', 'songs'));
    }

    /**
     * Menghapus catatan emosi tertentu.
     *
     * @param int $id ID dari catatan emosi yang akan dihapus.
     */
    public function destroyEmotion($id)
    {
        // Pastikan user terautentikasi
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Anda harus login untuk melakukan tindakan ini.');
        }

        // Cek apakah emotion note milik user yang sedang login sebelum menghapus
        $note = EmotionNote::where('user_id', Auth::id())->findOrFail($id);

        // Hapus emotion note
        $note->delete();

        // Kembalikan ke halaman rekomendasi dengan pesan sukses
        return redirect()->route('rekomendasi')->with('success', 'Jurnal berhasil dihapus!');
    }
}
