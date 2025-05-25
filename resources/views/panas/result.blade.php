@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-8 p-10 bg-white rounded-2xl shadow-xl border border-gray-200">

    @if(session('success'))
        <div class="mb-8 p-4 bg-blue-50 border border-blue-300 text-blue-700 rounded-lg text-center font-semibold">
            {{ session('success') }}
        </div>
    @endif

    @php
        use App\Models\PanasResult;
        use App\Models\MoodSong;

        $result = PanasResult::where('user_id', auth()->id())->latest()->first();
        $recommendedSongs = $result ? MoodSong::where('mood_type', determineMood($result->pa_score, $result->na_score))->get() : collect();

        $pa = $result ? $result->pa_score : 0;
        $na = $result ? $result->na_score : 0;
        $total = $pa + $na;

        $paPercent = $total > 0 ? round(($pa / $total) * 100) : 0;
        $naPercent = 100 - $paPercent;

        $radius = 80;
        $circumference = 2 * M_PI * $radius;

        $strokePA = $circumference * ($paPercent / 100);
        $strokeNA = $circumference * ($naPercent / 100);

        $colorPA = '#93c5fd'; // Biru pastel
        $colorNA = '#9ca3af'; // Abu-abu

        function determineMood($pa, $na) {
            $paMood = $pa > 35 ? 'tinggi' : ($pa >= 25 ? 'sedang' : 'rendah');
            $naMood = $na > 35 ? 'tinggi' : ($na >= 25 ? 'sedang' : 'rendah');

            if ($paMood === 'tinggi' && $naMood === 'rendah') return 'Positif';
            if ($paMood === 'rendah' && $naMood === 'tinggi') return 'Negatif';
            if ($paMood === 'tinggi' && $naMood === 'tinggi') return 'Campuran';
            if ($paMood === 'rendah' && $naMood === 'rendah') return 'Netral';

            return 'Netral';
        }

        $moodText = determineMood($pa, $na);
        $moodImages = [
            'Positif' => 'happy-mood.gif',
            'Negatif' => 'negatif-mood2.gif',
            'Netral'  => 'netral-mood.gif',
            'Campuran' => 'mix-mood.gif',
        ];
        $moodImage = asset('images/stickers/' . ($moodImages[$moodText] ?? 'netral-sticker.png'));
    @endphp

    @if($result)
<h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-blue-500 text-center mb-4">✨ Mood Result ✨</h1>
<p class="text-sm sm:text-base text-center text-gray-600 mb-12">
    Berikut ringkasan suasana hati Anda dari hasil kuesioner terakhir 💬
</p>

<div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 md:gap-x-8 items-center justify-items-center mb-16">
    <!-- Lingkaran Diagram PA/NA -->
    <div class="relative w-60 h-60">
        <svg width="240" height="240" class="transform -rotate-90">
            <circle cx="120" cy="120" r="{{ $radius }}" stroke="#f3f4f6" stroke-width="15" fill="none" />
            <circle
                cx="120"
                cy="120"
                r="{{ $radius }}"
                stroke="{{ $colorPA }}"
                stroke-width="15"
                fill="none"
                stroke-dasharray="{{ $strokePA }} {{ $circumference - $strokePA }}"
                stroke-dashoffset="0"
                stroke-linecap="round"
            />
            <circle
                cx="120"
                cy="120"
                r="{{ $radius }}"
                stroke="{{ $colorNA }}"
                stroke-width="15"
                fill="none"
                stroke-dasharray="{{ $strokeNA }} {{ $circumference - $strokeNA }}"
                stroke-dashoffset="-{{ $strokePA }}"
                stroke-linecap="round"
            />
        </svg>

        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center text-gray-800">
            <div class="text-base font-semibold">PA / NA</div>
            <div class="text-2xl font-bold">{{ $pa }} / {{ $na }}</div>
        </div>
    </div>


            <!-- Gambar Mood -->
            <div class="relative w-64 md:w-48 aspect-square rounded-2xl overflow-hidden shadow-md flex items-center justify-center bg-blue-50 border-4 border-blue-100">
                <img src="{{ $moodImage }}" alt="Sticker {{ $moodText }}" class="w-full h-full object-contain" />
            </div>
        </div>

        <p class="text-center text-xl font-semibold text-blue-600 mb-6">
            Mood Anda hari ini: <span class="font-extrabold">{{ $moodText }} 💙</span>
        </p>

        <div class="flex justify-center space-x-6 mb-12 text-sm text-gray-500">
            <div class="flex items-center space-x-2">
                <span class="inline-block w-4 h-4 rounded-full ring-2 ring-white" style="background-color: {{ $colorPA }}"></span>
                <span>PA (Positive Affect)</span>
            </div>
            <div class="flex items-center space-x-2">
                <span class="inline-block w-4 h-4 rounded-full ring-2 ring-white" style="background-color: {{ $colorNA }}"></span>
                <span>NA (Negative Affect)</span>
            </div>
        </div>

        <h2 class="text-xl font-bold mb-4 text-gray-800">Playlist Rekomendasi</h2>

        @if($recommendedSongs->isNotEmpty())
            <div class="flex space-x-4 overflow-x-auto pb-4">
                @foreach($recommendedSongs as $song)
                    <div class="w-36 flex-shrink-0 bg-white rounded-xl shadow-lg border border-gray-200 hover:shadow-xl transition cursor-pointer">
                        @if($song->album_cover)
                            <img src="{{ $song->album_cover }}" alt="Cover {{ $song->title }}" class="w-full h-32 object-cover rounded-t-xl">
                        @else
                            <div class="w-full h-32 bg-gray-100 flex items-center justify-center text-gray-400 text-xs rounded-t-xl">
                                🎶 No Image
                            </div>
                        @endif
                        <div class="p-2 text-center">
                            <p class="font-semibold text-gray-800 text-xs truncate" title="{{ $song->title }}">{{ $song->title }}</p>
                            <p class="text-gray-600 text-xs truncate" title="{{ $song->artist }}">oleh {{ $song->artist }}</p>
                            <a href="{{ $song->url }}" target="_blank"
                               class="inline-block mt-1 text-blue-500 hover:text-blue-700 font-semibold text-xs"
                               aria-label="Dengarkan lagu {{ $song->title }}">
                               🎧 Play
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500 italic mt-8">Belum ada rekomendasi musik untuk mood ini.</p>
        @endif

    @else
        <p class="text-center text-gray-500 italic py-20">Belum ada hasil kuesioner. Yuk isi dulu ya ✨</p>
    @endif

    <div class="mt-16 text-center">
        <a href="{{ route('panas.show') }}" class="inline-block text-blue-500 hover:text-blue-700 font-semibold text-lg transition">
            ← Kembali ke Kuesioner
        </a>
    </div>

</div>
@endsection
