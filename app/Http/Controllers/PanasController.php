<?php

namespace App\Http\Controllers;

use App\Models\PanasResult;
use App\Models\MoodSong;
use App\Models\PanasQuestion; // Assuming you have a PanasQuestion model
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

    /**
     * Store a newly created PANAS result in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data.
        // The 'responses' array should contain question_id => score.
        $validatedData = $request->validate([
            'responses' => 'required|array',
            'responses.*' => 'required|integer|min:1|max:5',
        ]);

        $paScore = 0;
        $naScore = 0;

        // Assuming your PanasQuestion model has a 'type' column ('positive' or 'negative')
        // to differentiate PA and NA questions.
        $questions = PanasQuestion::all()->keyBy('id'); // Get all questions keyed by ID for easy lookup

        foreach ($validatedData['responses'] as $questionId => $score) {
            $question = $questions->get($questionId);

            if ($question) {
                if ($question->type === 'positive') { // Example: 'positive' for PA questions
                    $paScore += $score;
                } elseif ($question->type === 'negative') { // Example: 'negative' for NA questions
                    $naScore += $score;
                }
            }
        }

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

        $radius = 70; // Must match the radius used in your panas.result view
        $circumference = 2 * M_PI * $radius;
        $strokePA = $circumference * ($paPercent / 100);
        $strokeNA = $circumference * ($naPercent / 100);
        $colorPA = '#2563eb'; // blue-600
        $colorNA = '#9ca3af'; // gray-400

        $moodText = $this->determineMood($pa, $na);
        $moodImages = [
            'Positif'  => 'happy-mood.gif',
            'Negatif'  => 'negatif-mood2.gif',
            'Netral'   => 'netral-mood.gif',
            'Campuran' => 'mix-mood.gif',
        ];
        $moodImage = asset('images/stickers/' . ($moodImages[$moodText] ?? 'netral-sticker.png'));

        $recommendedSongs = MoodSong::where('mood_type', $moodText)->get();

        return view($viewName, compact(
            'result', 'pa', 'na', 'paPercent', 'naPercent', 'radius', 'circumference',
            'strokePA', 'strokeNA', 'colorPA', 'colorNA', 'moodText', 'moodImage', 'recommendedSongs'
        ));
    }

    /**
     * Helper function to determine mood type based on PA and NA scores.
     */
    private function determineMood($pa, $na) {
        // Adjust these thresholds based on the actual PANAS scoring interpretation you are using
        // These are example thresholds for demonstration.
        $paMood = $pa > 35 ? 'tinggi' : ($pa >= 25 ? 'sedang' : 'rendah');
        $naMood = $na > 35 ? 'tinggi' : ($na >= 25 ? 'sedang' : 'rendah');

        if ($paMood === 'tinggi' && $naMood === 'rendah') return 'Positif';
        if ($paMood === 'rendah' && $naMood === 'tinggi') return 'Negatif';
        if ($paMood === 'tinggi' && $naMood === 'tinggi') return 'Campuran';
        if ($paMood === 'rendah' && $naMood === 'rendah') return 'Netral';

        // Fallback
        return 'Netral';
    }
}