<?php

namespace App\Http\Controllers;

use App\Models\PanasResult;
use App\Models\MoodSong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // Needed for Str::headline
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PanasController extends Controller
{
    /**
     * Display the PANAS questionnaire form.
     * Checks if the user has filled it this week to control access.
     */
    public function show() // <-- PASTIKAN METODE INI ADA DAN PUBLIC
    {
        // Check if the user has filled out the questionnaire this week (7 days)
        $latestPanasResult = PanasResult::where('user_id', Auth::id())
                                        ->latest()
                                        ->first();

        $hasFilledPanasThisWeek = false;
        if ($latestPanasResult) {
            // Check if the last submission was less than 7 days ago
            if ($latestPanasResult->created_at->gte(now()->subDays(7))) {
                $hasFilledPanasThisWeek = true;
            }
        }

        // Pass hasFilledPanasThisWeek to the view to control form display
        return view('panas.show', compact('hasFilledPanasThisWeek'));
    }

    /**
     * Store a newly created PANAS result in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'pa_score' => 'required|integer|min:10|max:50', // Assuming min/max scores
            'na_score' => 'required|integer|min:10|max:50', // Assuming min/max scores
        ]);

        $paScore = $validatedData['pa_score'];
        $naScore = $validatedData['na_score'];

        // Determine mood type using the private helper method
        $moodType = $this->determineMood($paScore, $naScore);

        // Create and save the PanasResult
        PanasResult::create([
            'user_id' => Auth::id(),
            'pa_score' => $paScore,
            'na_score' => $naScore,
            'mood_type' => $moodType,
        ]);

        // Redirect to the latest result page after submission
        return redirect()->route('panas.result')->with('success', 'Kuesioner berhasil diisi!');
    }

    /**
     * Display the LATEST PANAS result.
     * This is typically the target after a questionnaire submission.
     */
    public function showLatestResult() // Renamed from 'result' for clarity in previous discussions
    {
        $result = PanasResult::where('user_id', Auth::id())->latest()->first();

        if (!$result) {
            return redirect()->route('panas.show')->with('error', 'Belum ada hasil kuesioner. Silakan isi terlebih dahulu!');
        }

        // Prepare all data needed for the panas.result view
        $pa = $result->pa_score;
        $na = $result->na_score;
        $total = $pa + $na;
        $paPercent = $total > 0 ? round(($pa / $total) * 100) : 0;
        $naPercent = 100 - $paPercent;

        $radius = 70; // Must match the radius used in your panas.result view
        $circumference = 2 * M_PI * $radius;
        $strokePA = $circumference * ($paPercent / 100);
        $strokeNA = $circumference * ($naPercent / 100);
        $colorPA = '#2563eb'; // blue-600
        $colorNA = '#9ca3af'; // gray-400

        $moodText = $this->determineMood($pa, $na);
        $moodImages = [
            'Positif' => 'happy-mood.gif',
            'Negatif' => 'negatif-mood2.gif',
            'Netral'  => 'netral-mood.gif',
            'Campuran' => 'mix-mood.gif',
        ];
        $moodImage = asset('images/stickers/' . ($moodImages[$moodText] ?? 'netral-sticker.png'));

        $recommendedSongs = MoodSong::where('mood_type', $moodText)->get();

        return view('panas.result', compact(
            'result', 'pa', 'na', 'paPercent', 'naPercent', 'radius', 'circumference',
            'strokePA', 'strokeNA', 'colorPA', 'colorNA', 'moodText', 'moodImage', 'recommendedSongs'
        ));
    }

    /**
     * Display the user's history of PANAS results with pagination.
     */
    public function history()
    {
        $history = PanasResult::where('user_id', Auth::id())
                                ->latest() // Order by latest results
                                ->paginate(10); // Paginate, e.g., 10 items per page

        return view('panas.history', compact('history'));
    }

    /**
     * Display a SPECIFIC PANAS result from history in detail.
     */
    public function showResultDetail($id)
    {
        $result = PanasResult::where('user_id', Auth::id())->findOrFail($id);

        // Prepare all data for the specific result detail view
        $pa = $result->pa_score;
        $na = $result->na_score;
        $total = $pa + $na;
        $paPercent = $total > 0 ? round(($pa / $total) * 100) : 0;
        $naPercent = 100 - $paPercent;

        $radius = 70; // Must match the radius used in your panas.result view
        $circumference = 2 * M_PI * $radius;
        $strokePA = $circumference * ($paPercent / 100);
        $strokeNA = $circumference * ($naPercent / 100);
        $colorPA = '#2563eb'; // blue-600
        $colorNA = '#9ca3af'; // gray-400

        $moodText = $this->determineMood($pa, $na);
        $moodImages = [
            'Positif' => 'happy-mood.gif',
            'Negatif' => 'negatif-mood2.gif',
            'Netral'  => 'netral-mood.gif',
            'Campuran' => 'mix-mood.gif',
        ];
        $moodImage = asset('images/stickers/' . ($moodImages[$moodText] ?? 'netral-sticker.png'));

        $recommendedSongs = MoodSong::where('mood_type', $moodText)->get();

        return view('panas.result_detail', compact(
            'result', 'pa', 'na', 'paPercent', 'naPercent', 'radius', 'circumference',
            'strokePA', 'strokeNA', 'colorPA', 'colorNA', 'moodText', 'moodImage', 'recommendedSongs'
        ));
    }

    /**
     * Helper function to determine mood type based on PA and NA scores.
     */
    private function determineMood($pa, $na) {
        $paMood = $pa > 35 ? 'tinggi' : ($pa >= 25 ? 'sedang' : 'rendah');
        $naMood = $na > 35 ? 'tinggi' : ($na >= 25 ? 'sedang' : 'rendah');

        if ($paMood === 'tinggi' && $naMood === 'rendah') return 'Positif';
        if ($paMood === 'rendah' && $naMood === 'tinggi') return 'Negatif';
        if ($paMood === 'tinggi' && $naMood === 'tinggi') return 'Campuran';
        if ($paMood === 'rendah' && $naMood === 'rendah') return 'Netral';

        return 'Netral';
    }
}