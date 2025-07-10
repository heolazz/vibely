<?php

namespace App\Http\Controllers;

use App\Models\PanasResult;
use App\Models\MoodSong;
use App\Models\PanasQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PanasController extends Controller
{
    /**
     * Display the PANAS questionnaire form.
     * Checks if the user has filled it this week to control access.
     */
    public function show()
    {
        $user = Auth::user();

        // Cek apakah user sudah mengisi minggu ini
        $latestResult = PanasResult::where('user_id', $user->id)
            ->whereBetween('created_at', [
                now()->startOfWeek(), now()->endOfWeek()
            ])->first();

        if ($latestResult) {
            return view('panas.already_filled', compact('latestResult'));
        }

        // Ambil emosi
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

    /**
     * Store a newly created PANAS result in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'responses' => 'required|array',
            'responses.*' => 'required|integer|min:1|max:5',
        ]);

        $paScore = 0;
        $naScore = 0;

        $questions = PanasQuestion::all()->keyBy('id');

        foreach ($validatedData['responses'] as $questionId => $score) {
            $question = $questions->get($questionId);

            if ($question) {
                if ($question->type === 'positive') {
                    $paScore += $score;
                } elseif ($question->type === 'negative') {
                    $naScore += $score;
                }
            }
        }

        $moodType = $this->determineMood($paScore, $naScore);

        PanasResult::create([
            'user_id' => Auth::id(),
            'pa_score' => $paScore,
            'na_score' => $naScore,
            'mood_type' => $moodType,
        ]);

        return redirect()->route('panas.result')->with('success', 'Kuesioner berhasil diisi!');
    }

    /**
     * Display the LATEST PANAS result.
     */
    public function showLatestResult()
    {
        $result = PanasResult::where('user_id', Auth::id())->latest()->first();

        if (!$result) {
            return redirect()->route('panas.show')->with('error', 'Belum ada hasil kuesioner. Silakan isi terlebih dahulu!');
        }

        return $this->prepareResultView($result);
    }

    /**
     * Display the user's history of PANAS results with pagination.
     */
    public function history()
    {
        $history = PanasResult::where('user_id', Auth::id())
                               ->latest()
                               ->paginate(10);

        // Map through the history results to add the moodText and moodTagColor
        // This is where you prepare data for the view
        $history->getCollection()->transform(function ($result) {
            $result->moodText = $this->determineMood($result->pa_score ?? 0, $result->na_score ?? 0);
            $result->moodTagColor = $this->getMoodTagColor($result->moodText);
            return $result;
        });

        return view('panas.history', compact('history'));
    }

    /**
     * Display a SPECIFIC PANAS result from history in detail.
     */
    public function showResultDetail($id)
    {
        $result = PanasResult::where('user_id', Auth::id())->findOrFail($id);

        return $this->prepareResultView($result, 'panas.result_detail');
    }

    /**
     * Helper function to prepare data for result views (latest or detail).
     */
    private function prepareResultView($result, $viewName = 'panas.result')
    {
        $pa = $result->pa_score;
        $na = $result->na_score;
        $total = $pa + $na;
        $paPercent = $total > 0 ? round(($pa / $total) * 100) : 0;
        $naPercent = 100 - $paPercent;

        $radius = 70;
        $circumference = 2 * M_PI * $radius;
        $strokePA = $circumference * ($paPercent / 100);
        $strokeNA = $circumference * ($naPercent / 100);
        $colorPA = '#3b82f6';
        $colorNA = '#e5e7eb';

        $moodText = $this->determineMood($pa, $na);
        $moodImages = [
            'Positif'  => 'happy-mood.gif',
            'Negatif'  => 'negatif-mood2.gif',
            'Netral'   => 'netral-mood.gif',
            'Campuran' => 'mix-mood.gif',
        ];
        $moodImage = asset('images/stickers/' . ($moodImages[$moodText] ?? 'Netral-sticker.png'));

        $recommendedSongs = MoodSong::where('mood_type', $moodText)->get();

        return view($viewName, compact(
            'result', 'pa', 'na', 'paPercent', 'naPercent', 'radius', 'circumference',
            'strokePA', 'strokeNA', 'colorPA', 'colorNA', 'moodText', 'moodImage', 'recommendedSongs'
        ));
    }

    /**
     * Helper function to determine mood type based on PA and NA scores.
     * This now includes the extended logic for "Cenderung Positif/Negatif".
     */
    private function determineMood($pa, $na) {
        // Menghitung level PA dan NA
        $paMood = $pa > 35 ? 'tinggi' : ($pa >= 25 ? 'sedang' : 'rendah');
        $naMood = $na > 35 ? 'tinggi' : ($na >= 25 ? 'sedang' : 'rendah');

        // Menentukan tipe Mood
        if ($paMood === 'tinggi' && $naMood === 'rendah') return 'Positif';
        if ($paMood === 'rendah' && $naMood === 'tinggi') return 'Negatif';
        if ($paMood === 'tinggi' && $naMood === 'tinggi') return 'Campuran';
        if ($paMood === 'rendah' && $naMood === 'rendah') return 'Netral';

        
        if ($paMood === 'sedang' && $naMood === 'sedang') return 'Netral';
        if ($paMood === 'tinggi' && $naMood === 'sedang') return 'Positif';
        if ($paMood === 'sedang' && $naMood === 'rendah') return 'Positif';
        if ($paMood === 'rendah' && $naMood === 'sedang') return 'Negatif';
        if ($paMood === 'sedang' && $naMood === 'tinggi') return 'Negatif';

        // Default
        return 'Netral';
    }

    /**
     * Helper function to get mood tag color.
     */
    private function getMoodTagColor($moodText) {
        switch ($moodText) {
            case 'Positif':
            case 'Cenderung Positif':
                return 'bg-blue-100 text-blue-800';
            case 'Negatif':
            case 'Cenderung Negatif':
                return 'bg-gray-100 text-gray-800';
            case 'Campuran':
                return 'bg-purple-100 text-purple-800';
            case 'Netral':
            default:
                return 'bg-gray-100 text-gray-800';
        }
    }
}