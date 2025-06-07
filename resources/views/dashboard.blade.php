@extends('layouts.app')

@section('content')
@if(Auth::user()->role == 'admin')
    @php
        header("Location: " . route('admin.dashboard'));
        exit;
    @endphp
@else

<section class="bg-white py-8 sm:py-10 min-h-screen flex flex-col justify-center">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 w-full flex-grow flex flex-col justify-center">
        <h1 class="text-3xl sm:text-4xl md:text-4xl font-extrabold text-gray-900 tracking-tight text-center mb-8">
            Selamat datang kembali, <span class="text-blue-600">{{ Auth::user()->name }}</span> 👋
        </h1>

        {{-- MAIN TOP CONTAINER: MOOD, JURNAL, FITUR CEPAT (3 Columns) --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8 flex-grow items-stretch"> {{-- items-stretch to make columns equal height --}}

            {{-- COLUMN 1: CARD MOOD TERAKHIR (PANAS) --}}
            <div class="lg:col-span-1 bg-white p-6 rounded-2xl flex flex-col justify-between items-center text-center relative overflow-hidden transition-all duration-300 hover:shadow-xl hover:scale-[1.005]">
                <span class="absolute top-4 right-4 text-gray-400 text-xs font-semibold uppercase tracking-wider">
                    Mood
                </span>
                <div class="flex flex-col items-center mb-4 mt-2">
                    <img src="{{ $moodImage }}" alt="Mood Sticker" class="w-28 h-28 sm:w-36 sm:h-36 object-contain mb-3 animate-float-slow">
                    <h2 class="text-2xl font-bold text-gray-900">Mood Terakhir Anda</h2>
                </div>

                @if($latestPanasResult)
                    <p class="text-xl text-blue-600 font-semibold mb-2">{{ $moodText }}</p>
                    <p class="text-xs text-gray-500 mb-4">Diperbarui: {{ $latestPanasResult->created_at->isoFormat('DD MMMM [') }}</p>

                    {{-- Recommended Music based on Mood --}}
                    @if($recommendedMoodSong)
                        <a href="{{ $recommendedMoodSong->url }}" target="_blank" class="block w-full text-left p-2 bg-blue-50 rounded-lg mb-4 border border-blue-100 transition-all duration-300 hover:bg-blue-100 hover:shadow-sm cursor-pointer">
                            <p class="text-xs font-semibold text-blue-700 mb-1">Musik untuk Mood Ini:</p>
                            <div class="flex items-center">
                                @if($recommendedMoodSong->album_cover)
                                    <img src="{{ $recommendedMoodSong->album_cover }}" alt="Album Cover" class="w-8 h-8 rounded-md mr-2 object-cover shadow-sm">
                                @else
                                    <div class="w-8 h-8 rounded-md bg-blue-200 flex items-center justify-center mr-2 text-blue-600 text-sm shadow-sm">🎶</div>
                                @endif
                                <div class="flex-grow">
                                    <p class="text-sm font-medium text-gray-800 truncate">{{ $recommendedMoodSong->title }}</p>
                                    <p class="text-xs text-gray-600 truncate">oleh {{ $recommendedMoodSong->artist }}</p>
                                </div>
                                <span class="ml-2 text-blue-500 hover:text-blue-700 text-base flex-shrink-0">
                                    ▶️
                                </span>
                            </div>
                        </a>
                    @else
                        <p class="text-xs text-gray-500 mb-4 italic">Belum ada rekomendasi musik spesifik untuk mood ini.</p>
                    @endif

                    @if(!$hasFilledPanasThisWeek)
                        <a href="{{ route('panas.show') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-full text-base font-semibold hover:bg-blue-700 transition duration-300 shadow-md mt-auto">
                            Isi Kuesioner Mingguan
                        </a>
                    @else
                        <p class="text-base text-gray-700 mb-2 mt-auto">Anda sudah mengisi minggu ini!</p>
                        <a href="{{ route('panas.result') }}" class="text-blue-500 hover:underline text-xs">Lihat Hasil Detail Mood</a>
                    @endif
                @else
                    <p class="text-base text-gray-600 mb-6">Belum ada data mood. Ayo isi kuesioner pertama Anda!</p>
                    <a href="{{ route('panas.show') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-full text-base font-semibold hover:bg-blue-700 transition duration-300 shadow-md mt-auto">
                        Mulai Kuesioner Mood
                    </a>
                @endif
                <a href="{{ route('panas.history') }}" class="mt-3 text-blue-500 hover:underline text-xs">Riwayat Mood Saya</a>
            </div>

            {{-- COLUMN 2: CARD JURNAL EMOSI & MUSIK --}}
            <div class="lg:col-span-1 bg-white p-6 rounded-2xl flex flex-col justify-between items-center text-center relative transition-all duration-300 hover:shadow-xl hover:scale-[1.005]">
                <span class="absolute top-4 right-4 text-gray-400 text-xs font-semibold uppercase tracking-wider">
                    Jurnal
                </span>
                <div class="flex flex-col items-center mb-4 mt-2">
                    <img src="{{ asset('icons/icon-journal.png') }}" alt="Jurnal Emosi" class="w-28 h-28 sm:w-36 sm:h-36 object-contain mb-3">
                    <h2 class="text-2xl font-bold text-gray-900">Jurnal Emosi Anda</h2>
                </div>

                @if($latestMoodNote)
                    <p class="text-xl text-blue-600 font-semibold mb-2">
                        Terakhir merasa: <span class="font-bold">{{ $latestMoodNote->emotion }}</span>
                    </p>
                    <p class="text-sm text-gray-600 italic mb-4 max-w-sm truncate mx-auto">
                        "{{ Str::limit($latestMoodNote->note, 100) }}"
                    </p>
                    <p class="text-xs text-gray-500 mb-4">Dicatat {{ $latestMoodNote->created_at->diffForHumans() }}</p>
                    <a href="{{ route('rekomendasi') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-full text-base font-semibold hover:bg-blue-700 transition duration-300 shadow-md mt-auto">
                        Buat Jurnal Baru & Dengar Musik
                    </a>
                    <a href="{{ route('emotion.show', $latestMoodNote->id) }}" class="mt-3 text-blue-500 hover:underline text-xs">Lihat Detail Jurnal Ini</a>
                @else
                    <p class="text-base text-gray-600 mb-6">Belum ada jurnal emosi. Mari ceritakan perasaan Anda dan dapatkan rekomendasi musik!</p>
                    <a href="{{ route('rekomendasi') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-full text-base font-semibold hover:bg-blue-700 transition duration-300 shadow-md mt-auto">
                        Mulai Jurnal & Musik
                    </a>
                @endif
            </div>

            {{-- COLUMN 3: FITUR CEPAT --}}
            <div class="lg:col-span-1 bg-white p-6 rounded-2xl  flex flex-col relative transition-all duration-300 hover:shadow-xl hover:scale-[1.005]">
                <span class="absolute top-4 right-4 text-gray-400 text-xs font-semibold uppercase tracking-wider">
                    Akses Cepat
                </span>
                <div class="flex items-center gap-4 mb-4 mt-2">
                    <!-- <img src="{{ asset('icons/icon-new.png') }}" alt="Fitur Cepat" class="w-14 h-14 sm:w-16 sm:h-16 object-contain"> -->
                    <h2 class="text-2xl font-bold text-gray-900">Fitur Cepat Lainnya</h2>
                </div>
                {{-- Grid for quick tools, adjusted for 1/3 column width --}}
                <div class="grid grid-cols-2 gap-3 justify-items-center flex-grow overflow-y-auto custom-scrollbar pr-1"> {{-- Added custom-scrollbar and pr-1 for scrollbar if needed --}}
                    @php
                        $quickTools = [
                            ['icon' => asset('icons/icon-kuesioner.png'), 'title' => 'Isi PANAS', 'route' => route('panas.show')],
                            ['icon' => asset('icons/icon-new.png'), 'title' => 'Hasil PANAS', 'route' => route('panas.result')],
                            ['icon' => asset('icons/icon-history.png'), 'title' => 'Riwayat Mood', 'route' => route('panas.history')],
                            ['icon' => asset('icons/icon-music.png'), 'title' => 'Rekomendasi Musik', 'route' => route('rekomendasi')],
                            ['icon' => asset('icons/icon-education.png'), 'title' => 'Baca Artikel', 'route' => route('artikel.index')],
                            // Add more quick tools as needed. They will create a scrollbar if they overflow.
                            ['icon' => asset('icons/icon-journal.png'), 'title' => 'Riwayat Jurnal', 'route' => route('rekomendasi')], // Example: assuming rekomendasi page lists all journals
                            //['icon' => asset('icons/icon-chart.png'), 'title' => 'Analisis Mood', 'route' => '#'], // Placeholder for future feature
                        ];
                    @endphp

                    @foreach($quickTools as $tool)
                        <a href="{{ $tool['route'] }}" class="flex flex-col items-center justify-center p-2 w-full h-24 bg-gray-50 rounded-lg border border-gray-100 transition-all duration-300 hover:bg-blue-50 hover:border-blue-200 group text-center shadow-sm hover:shadow-md">
                            <img src="{{ $tool['icon'] }}" alt="{{ $tool['title'] }}" class="w-10 h-10 mb-1 group-hover:scale-110 transition-transform">
                            <p class="text-xs font-semibold text-gray-800 group-hover:text-blue-700">{{ $tool['title'] }}</p>
                        </a>
                    @endforeach
                </div>
            </div>

        </div> {{-- END OF MAIN TOP CONTAINER --}}
    </div>
</section>

{{-- LIST ARTIKEL - Full Width Section Below --}}
<section class="bg-white py-10 sm:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-8">Artikel Seputar Kesehatan Mental</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($articles as $article)
                <a href="{{ route('artikel.show', $article->id) }}" class="block p-4 bg-white rounded-xl border border-gray-100 transition-all duration-300 hover:bg-blue-50 hover:border-blue-200 shadow-sm hover:shadow-md">
                    <h3 class="font-semibold text-lg text-gray-900 mb-2">{{ $article->title }}</h3>
                    <p class="text-sm text-gray-700 mb-3">{{ Str::limit($article->excerpt, 150) }}</p>
                    <span class="text-xs text-blue-600 hover:underline font-medium">Baca Selengkapnya &rarr;</span>
                </a>
            @empty
                <p class="md:col-span-3 text-center text-gray-600 italic py-6">Belum ada artikel yang tersedia saat ini.</p>
            @endforelse
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('artikel.index') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-blue-700 transition duration-300 shadow-lg">
                Lihat Semua Artikel
            </a>
        </div>
    </div>
</section>

@endif
@endsection