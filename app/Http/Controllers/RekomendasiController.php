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
        $explanation = null;

        if ($emotion) {
            $songs = Song::where('emotion', $emotion)->get();

            // --- PERUBAHAN DI SINI ---
            // Acak lagu dan ambil hanya 5 lagu secara acak
            if ($songs->isNotEmpty()) {
                $songs = $songs->shuffle()->take(2); // Ambil 5 lagu secara acac
            }
            // --- AKHIR PERUBAHAN ---

            // Get explanation based on emotion
            $explanation = $this->getEmotionExplanation($emotion);
        }

        // Teruskan $emotionCounts, $daysFilter, dan $explanation ke view
        return view('rekomendasi', compact('emotionNotes', 'songs', 'emotion', 'emotionCounts', 'daysFilter', 'explanation'));
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

        // --- PERUBAHAN DI SINI JUGA UNTUK TAMPILAN DETAIL ---
        // Acak lagu dan ambil hanya 5 lagu secara acak untuk tampilan detail
        if ($songs->isNotEmpty()) {
            $songs = $songs->shuffle()->take(5); // Ambil 5 lagu secara acak
        }
        // --- AKHIR PERUBAHAN ---

        // Get explanation for the emotion in the detail view
        $explanation = $this->getEmotionExplanation($emotionNote->emotion);


        // Teruskan catatan emosi, lagu-lagu, dan penjelasan ke view detail
        return view('emotion_note_detail', compact('emotionNote', 'songs', 'explanation'));
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

    /**
     * Mengembalikan penjelasan untuk setiap emosi berdasarkan model Circumplex.
     *
     * @param string $emotion Nama emosi (Senang, Sedih, Marah, Cemas).
     * @return string Penjelasan tentang pemilihan musik untuk emosi tersebut.
     */
    private function getEmotionExplanation(string $emotion): string
    {
        switch (strtolower($emotion)) {
            case 'marah':
                return "Untuk emosi marah, musik dengan <span class=\"info-term\" data-term=\"energy\">energi</span> tinggi (> 0,67) dan <span class=\"info-term\" data-term=\"valence\">valence</span> rendah hingga sedang (< 0,66) dipilih agar Anda dapat menyalurkan emosi secara sehat. Musik dengan intensitas tinggi seperti genre metal atau rock dapat membantu memproses emosi marah secara konstruktif, membantu Anda merasa lebih aktif dan terinspirasi, serta menurunkan stres dan iritasi.";
            case 'cemas':
                return "Untuk emosi cemas, lagu-lagu dipilih dengan <span class=\"info-term\" data-term=\"valence\">valence</span> dan <span class=\"info-term\" data-term=\"energy\">energi</span> rendah hingga sedang (< 0,66), untuk menenangkan pikiran dan tubuh Anda. Musik yang lambat, lembut, atau instrumental sangat cocok untuk membantu mengurangi ketegangan dan rasa gelisah.";
            case 'sedih':
                return "Untuk emosi sedih, musik cenderung memiliki <span class=\"info-term\" data-term=\"valence\">valence</span> rendah (< 0,33) dan <span class=\"info-term\" data-term=\"energy\">energi</span> rendah hingga sedang (< 0,66), untuk menciptakan ruang refleksi atau membantu proses ekspresi emosional. Beberapa lagu dengan <span class=\"info-term\" data-term=\"valence\">valence</span> sedikit lebih tinggi juga disertakan untuk memberikan nuansa harapan dan pemulihan.";
            case 'senang':
                return "Untuk emosi senang, musik yang dipilih memiliki <span class=\"info-term\" data-term=\"valence\">valence</span> tinggi (> 0,67) dan <span class=\"info-term\" data-term=\"energy\">energi</span> sedang hingga tinggi (0,34 < energi < 1), untuk mempertahankan dan memperkuat suasana hati positif Anda. Lagu-lagu ini cenderung ceria, bersemangat, dan cocok untuk meningkatkan semangat serta motivasi.";
            default:
                return "Rekomendasi musik didasarkan pada analisis emosi Anda menggunakan model <span class=\"info-term\" data-term=\"valence\">Valence</span> dan <span class=\"info-term\" data-term=\"energy\">Energy</span>. Setiap emosi memiliki karakteristik musik yang sesuai untuk mendukung suasana hati Anda.";
        }
    }
}