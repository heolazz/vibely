<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\PanasResult;  // Import the PanasResult model
use App\Models\EmotionNote;  // Import the EmotionNote model (your Moodnote model)
use Illuminate\Support\Facades\Auth; // Import Auth facade
use App\Models\MoodSong; // <-- THIS LINE IS CRUCIAL!

class UserController extends Controller
{
  public function index()
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $articles = Article::latest()->take(6)->get(); // Still fetch for the bottom section

        $latestPanasResult = PanasResult::where('user_id', Auth::id())
                                        ->latest()
                                        ->first();

        $moodImage = $this->getMoodImageBasedOnPanas($latestPanasResult);
        $moodText = $latestPanasResult ? $this->determineMoodTypeForPanas($latestPanasResult->pa_score, $latestPanasResult->na_score) : 'Netral';

        $latestMoodNote = EmotionNote::where('user_id', Auth::id())
                                     ->latest()
                                     ->first();

        $hasFilledPanasThisWeek = PanasResult::where('user_id', Auth::id())
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->exists();

        // <--- NEW: Fetch recommended song based on the latest mood type
        $recommendedMoodSong = null;
        if ($latestPanasResult) {
            $recommendedMoodSong = MoodSong::where('mood_type', $latestPanasResult->mood_type)
                                           ->inRandomOrder() // Get a random song for that mood type
                                           ->first();
        }

        return view('dashboard', compact(
            'articles',
            'latestPanasResult',
            'moodImage',
            'moodText',
            'latestMoodNote',
            'hasFilledPanasThisWeek',
            'recommendedMoodSong' // <--- NEW: Pass the recommended song
        ));
    }
    /**
     * Helper function to determine the mood image path based on PANAS scores.
     * This logic is copied from your PANASController's determineMood function.
     * Consider extracting this into a dedicated service or trait if used widely.
     */
    private function getMoodImageBasedOnPanas($panasResult)
    {
        // If no PANAS result exists, return a default neutral image.
        if (!$panasResult) {
            return asset('images/stickers/netral-sticker.png');
        }

        $pa = $panasResult->pa_score;
        $na = $panasResult->na_score;

        // Get the descriptive mood text (e.g., 'Positif', 'Negatif').
        $moodText = $this->determineMoodTypeForPanas($pa, $na);

        // Map the mood text to the corresponding sticker image filename.
        $moodImages = [
            'Positif'           => 'happy-mood.gif',
            'Negatif'           => 'negatif-mood2.gif',
            'Netral'            => 'netral-mood.gif',
            'Campuran'          => 'mix-mood.gif',
            'Cenderung Positif' => 'happy-mood.gif', // Reusing existing images for nuanced moods
            'Cenderung Negatif' => 'negatif-mood2.gif',
        ];

        // Construct the full asset path, with a fallback to a neutral sticker.
        return asset('images/stickers/' . ($moodImages[$moodText] ?? 'netral-sticker.png'));
    }

    /**
     * Helper function to determine the mood type string (e.g., 'Positif', 'Negatif').
     * This is a direct replication of the logic found in your PANASController.
     */
    private function determineMoodTypeForPanas($pa, $na)
    {
        // Determine levels of Positive Affect (PA) and Negative Affect (NA)
        $paMood = $pa > 35 ? 'tinggi' : ($pa >= 25 ? 'sedang' : 'rendah');
        $naMood = $na > 35 ? 'tinggi' : ($na >= 25 ? 'sedang' : 'rendah'); // Corrected 'sedah' to 'sedang'

        // Logic to combine PA and NA levels into a mood type
        if ($paMood === 'tinggi' && $naMood === 'rendah') return 'Positif';
        if ($paMood === 'rendah' && $naMood === 'tinggi') return 'Negatif';
        if ($paMood === 'tinggi' && $naMood === 'tinggi') return 'Campuran';
        if ($paMood === 'rendah' && $naMood === 'rendah') return 'Netral';

        // Additional handling for 'sedang' (medium) conditions
        if ($paMood === 'sedang' && $naMood === 'sedang') return 'Netral';
        if ($paMood === 'tinggi' && $naMood === 'sedang') return 'Cenderung Positif';
        if ($paMood === 'sedang' && $naMood === 'rendah') return 'Cenderung Positif';
        if ($paMood === 'rendah' && $naMood === 'sedang') return 'Cenderung Negatif';
        if ($paMood === 'sedang' && $naMood === 'tinggi') return 'Cenderung Negatif';

        // Default case if none of the above conditions are met
        return 'Netral';
    }

    // Your existing method for filtering articles by category.
    // This seems to be for an admin-specific view, as it returns to 'admin.articles.index'.
    public function filterArticlesByCategory(Request $request)
    {
        $category = $request->input('category');

        if ($category && $category !== 'Semua') {
            $articles = Article::where('category', $category)->latest()->paginate(10);
        } else {
            $articles = Article::latest()->paginate(10);
        }

        return view('admin.articles.index', compact('articles', 'category'));
    }
}