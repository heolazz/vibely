<?php

namespace App\Http\Controllers;

use App\Models\PanasQuestion;
use App\Models\PanasResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\MoodSong;

class PANASController extends Controller
{
    public function show()
    {
        $user = Auth::user();
    
        // buat Cek apakah user sudah mengisi minggu ini
        $latestResult = PanasResult::where('user_id', $user->id)
            ->whereBetween('created_at', [
                now()->startOfWeek(), now()->endOfWeek()
            ])->first();
    
        if ($latestResult) {
            return view('panas.already_filled', compact('latestResult'));
        }
    
        // buat Ambil emosi
        $emotions = PanasQuestion::select('emotion', 'type')->distinct()->get();
    
        $questions = [];
    
        foreach ($emotions as $emo) {
            $randomQuestion = PanasQuestion::where('emotion', $emo->emotion)
                ->inRandomOrder()
                ->first();
    
            if ($randomQuestion) {
                $questions[] = $randomQuestion;
            }
        }
    
        return view('panas.form', compact('questions'));
    }
    

    public function store(Request $request)
{
    // Validasi jika user sudah mengisi semua pertanyaan
    $request->validate([
        'responses' => 'required|array',
        'responses.*' => 'required|integer|between:1,5', // Pastikan jawaban adalah angka 1-5
    ]);

    $paScore = 0;
    $naScore = 0;

    foreach ($request->responses as $questionId => $value) {
        $question = PanasQuestion::find($questionId);

        if ($question) {
            // Hitung skor PA dan NA berdasarkan jenis pertanyaan
            if ($question->type === 'positive') {
                $paScore += (int)$value;
            } elseif ($question->type === 'negative') {
                $naScore += (int)$value;
            }
        }
    }

    $moodType = $this->determineMood($paScore, $naScore);

    // Simpan hasil kuesioner ke dalam database
    PanasResult::create([
        'user_id' => Auth::id(),
        'pa_score' => $paScore,
        'na_score' => $naScore,
        'mood_type' => $moodType,
    ]);

     // Ambil rekomendasi musik berdasarkan mood
     $recommendedSongs = MoodSong::where('mood_type', $moodType)->get();

    // Redirect ke halaman hasil
    return redirect()->route('panas.result')->with('success', 'Kuesioner berhasil disimpan!');
}


private function determineMood($pa, $na)
{
    // Menghitung level PA dan NA
    $paMood = $pa > 35 ? 'tinggi' : ($pa >= 25 ? 'sedang' : 'rendah');
    $naMood = $na > 35 ? 'tinggi' : ($na >= 25 ? 'sedang' : 'rendah');

    // Menentukan tipe mood berdasarkan kombinasi PA dan NA
    if ($paMood === 'tinggi' && $naMood === 'rendah') return 'Positif';
    if ($paMood === 'rendah' && $naMood === 'tinggi') return 'Negatif';
    if ($paMood === 'tinggi' && $naMood === 'tinggi') return 'Campuran';
    if ($paMood === 'rendah' && $naMood === 'rendah') return 'Netral';

    // Penanganan tambahan untuk kondisi sedang
    if ($paMood === 'sedang' && $naMood === 'sedang') return 'Netral';
    if ($paMood === 'tinggi' && $naMood === 'sedang') return 'Positif';
    if ($paMood === 'sedang' && $naMood === 'rendah') return 'Positif';
    if ($paMood === 'rendah' && $naMood === 'sedang') return 'Negatif';
    if ($paMood === 'sedang' && $naMood === 'tinggi') return 'Negatif';

    // Default
    return 'Netral';
}


    public function result()
    {
        // Ambil hasil kuesioner terbaru
        $result = PanasResult::where('user_id', Auth::id())
            ->latest()
            ->first();

        // Ambil rekomendasi musik berdasarkan mood
        $recommendedSongs = session('recommendedSongs', []);

        return view('panas.result', compact('result', 'recommendedSongs'));
    }

    public function history()
{
    $user = Auth::user();

    // Ambil semua hasil kuesioner untuk pengguna ini, urutkan berdasarkan tanggal terbaru
    $history = PanasResult::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('panas.history', compact('history'));
}
}
