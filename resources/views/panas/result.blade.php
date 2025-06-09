@extends('layouts.app')

@section('content')
{{-- Kontainer utama dengan latar belakang putih atau gradien sangat lembut --}}
<section class="bg-white py-12 sm:py-16 min-h-screen flex flex-col justify-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 w-full">

        @if(session('success'))
            <div class="mb-8 p-4 bg-blue-50 border border-blue-200 text-blue-700 rounded-lg text-center font-semibold">
                {{ session('success') }}
            </div>
        @endif

        @php
            use App\Models\PanasResult;
            use App\Models\MoodSong;

            $result = PanasResult::where('user_id', auth()->id())->latest()->first();
            // Pastikan fungsi determineMood ini ada dan bisa diakses (di helper atau controller, bukan inline di blade)
            // Untuk sementara, saya akan biarkan inline agar kode ini lengkap, tapi sebaiknya dipindahkan.
            function determineMood($pa, $na) {
                $paMood = $pa > 35 ? 'tinggi' : ($pa >= 25 ? 'sedang' : 'rendah');
                $naMood = $na > 35 ? 'tinggi' : ($na >= 25 ? 'sedang' : 'rendah');

                if ($paMood === 'tinggi' && $naMood === 'rendah') return 'Positif';
                if ($paMood === 'rendah' && $naMood === 'tinggi') return 'Negatif';
                if ($paMood === 'tinggi' && $naMood === 'tinggi') return 'Campuran';
                if ($paMood === 'rendah' && $naMood === 'rendah') return 'Netral';

                // Tambahan penanganan untuk kondisi sedang, seperti di controller Anda
                if ($paMood === 'sedang' && $naMood === 'sedang') return 'Netral';
                if ($paMood === 'tinggi' && $naMood === 'sedang') return 'Positif';
                if ($paMood === 'sedang' && $naMood === 'rendah') return 'Positif';
                if ($paMood === 'rendah' && $naMood === 'sedang') return 'Negatif';
                if ($paMood === 'sedang' && $naMood === 'tinggi') return 'Negatif';

                return 'Netral'; // Default jika tidak ada yang cocok
            }

            $moodText = determineMood($result->pa_score ?? 0, $result->na_score ?? 0);
            $recommendedSongs = $result ? MoodSong::where('mood_type', $moodText)->get() : collect();

            $pa = $result ? $result->pa_score : 0;
            $na = $result ? $result->na_score : 0;
            $total = $pa + $na;

            $paPercent = $total > 0 ? round(($pa / $total) * 100) : 0;
            $naPercent = 100 - $paPercent;

            $radius = 70;
            $circumference = 2 * M_PI * $radius;

            $strokePA = $circumference * ($paPercent / 100);
            $strokeNA = $circumference * ($naPercent / 100);

            // Sesuaikan warna agar lebih dekat dengan dashboard (biru/gray netral)
            $colorPA = '#2563eb'; // blue-600
            $colorNA = '#9ca3af'; // gray-400

            $moodImages = [
                'Positif' => 'happy-mood.gif',
                'Negatif' => 'negatif-mood2.gif',
                'Netral'  => 'netral-mood.gif',
                'Campuran' => 'mix-mood.gif',
                //'Cenderung Positif' => 'happy-mood.gif',
                //'Cenderung Negatif' => 'negatif-mood2.gif',
            ];
            $moodImage = asset('images/stickers/' . ($moodImages[$moodText] ?? 'netral-sticker.png'));
        @endphp

        @if($result)
            <h1 class="text-3xl sm:text-4xl md:text-4xl font-extrabold text-gray-900 tracking-tight text-center mb-8">
                Hasil Analisis <span class="text-blue-600">Mood Anda</span>
            </h1>

            {{-- Kartu Utama Hasil Mood --}}
            <div class="bg-white p-6 sm:p-8 rounded-2xl  border border-gray-200 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 md:gap-x-12 items-center justify-items-center">
                    <div class="relative w-56 h-56 flex items-center justify-center">
                        <svg width="224" height="224" class="transform -rotate-90">
                            <circle cx="112" cy="112" r="{{ $radius }}" stroke="#e5e7eb" stroke-width="15" fill="none" />
                            <circle
                                cx="112"
                                cy="112"
                                r="{{ $radius }}"
                                stroke="{{ $colorPA }}"
                                stroke-width="15"
                                fill="none"
                                stroke-dasharray="{{ $strokePA }} {{ $circumference - $strokePA }}"
                                stroke-dashoffset="0"
                                stroke-linecap="round"
                            />
                            <circle
                                cx="112"
                                cy="112"
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
                            <div class="text-xl font-semibold">PA / NA</div>
                            <div class="text-3xl font-extrabold text-blue-600">{{ $pa }} / {{ $na }}</div>
                        </div>
                    </div>

                    <div class="flex flex-col items-center text-center">
                        <div class="w-40 h-40 relative flex items-center justify-center bg-blue-50 rounded-2xl border-4 border-blue-100 p-2 shadow-sm">
                            <img src="{{ $moodImage }}" alt="Sticker {{ $moodText }}" class="w-full h-full object-contain" />
                        </div>
                        <p class="text-xl font-bold text-blue-600 mt-6 mb-4">
                            Mood Anda hari ini: <span class="font-extrabold">{{ $moodText }}</span>
                        </p>
                        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-6 text-sm text-gray-600">
                            <div class="flex items-center space-x-2">
                                <span class="inline-block w-4 h-4 rounded-full" style="background-color: {{ $colorPA }}"></span>
                                <span>PA (Positive Affect)</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="inline-block w-4 h-4 rounded-full" style="background-color: {{ $colorNA }}"></span>
                                <span>NA (Negative Affect)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kartu Rekomendasi Musik (Tampilan Baru) --}}
            <div class="bg-white p-6 sm:p-8 rounded-2xl  border border-gray-200 mt-8">
                <h2 class="text-2xl font-bold mb-6 text-gray-900 text-center">Playlist Rekomendasi untuk Anda</h2>

                @if($recommendedSongs->isNotEmpty())
                    <div class="space-y-3">
                        @foreach($recommendedSongs as $song)
                            <a href="{{ $song->url }}" target="_blank" class="block bg-gray-50 rounded-lg p-3 flex items-center justify-between border border-gray-200 hover:bg-gray-100 transition duration-200">
                                <div class="flex-1 min-w-0 pr-4">
                                    <p class="font-semibold text-gray-900 truncate" title="{{ $song->title }}">{{ $song->title }}</p>
                                    <p class="text-sm text-gray-600 truncate" title="{{ $song->artist }}">oleh {{ $song->artist }}</p>
                                </div>
                                {{-- SVG Icon Play Baru --}}
                                <div class="text-blue-500 hover:text-blue-700 flex-shrink-0" style="width: 28px; height: 28px;">
                                    <svg viewBox="0 0 512 512" style="fill: currentColor;">
                                        <g>
                                            <path d="M256,0C114.625,0,0,114.625,0,256c0,141.374,114.625,256,256,256c141.374,0,256-114.626,256-256		C512,114.625,397.374,0,256,0z M351.062,258.898l-144,85.945c-1.031,0.626-2.344,0.657-3.406,0.031		c-1.031-0.594-1.687-1.702-1.687-2.937v-85.946v-85.946c0-1.218,0.656-2.343,1.687-2.938c1.062-0.609,2.375-0.578,3.406,0.031		l144,85.962c1.031,0.586,1.641,1.718,1.641,2.89C352.703,257.187,352.094,258.297,351.062,258.898z"/>
                                        </g>
                                    </svg>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="text-center mt-8">
                           <a href="{{ route('musik.daftar') }}" class="inline-block text-blue-600 hover:text-blue-700 font-semibold text-sm transition">
                                Lihat Semua Rekomendasi Musik →
                           </a>
                    </div>
                @else
                    <p class="text-center text-gray-500 italic mt-4">Belum ada rekomendasi musik spesifik untuk mood ini.</p>
                    <p class="text-center text-gray-500 italic text-sm mt-2">Coba jelajahi <a href="{{ route('musik.daftar') }}" class="text-blue-500 hover:underline">daftar musik lengkap</a> kami.</p>
                @endif
            </div>

        @else
            <div class="bg-white p-8 rounded-2xl  border border-gray-200 text-center py-20">
                <p class="text-gray-600 italic text-xl">Belum ada hasil kuesioner ditemukan. Silakan isi kuesioner Anda sekarang! ✨</p>
            </div>
        @endif

        {{-- Tombol aksi di bagian bawah --}}
        <div class="mt-12 text-center">
            <a href="{{ route('panas.show') }}" class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-full text-base font-semibold hover:bg-blue-700 transition duration-300 shadow-md">
                Isi Kuesioner Baru
            </a>
            <p class="mt-4 text-sm text-gray-500">
                Atau lihat riwayat mood Anda: <a href="{{ route('panas.history') }}" class="text-blue-600 hover:underline font-medium">Riwayat Mood Saya</a>
            </p>
        </div>

    </div>
</section>
@endsection

@push('styles')
<style>
    /* Custom scrollbar untuk rekomendasi musik (jika tampilan grid ternyata masih butuh scroll) */
    .custom-scrollbar::-webkit-scrollbar {
        height: 6px; /* Tinggi scrollbar horizontal */
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1; /* Warna track scrollbar */
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #a0aec0; /* Warna thumb scrollbar (gray-400) */
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #718096; /* Warna thumb saat hover (gray-600) */
    }

    /* Untuk Firefox */
    .custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #a0aec0 #f1f1f1;
    }
</style>
@endpush