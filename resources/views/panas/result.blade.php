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

        @if($result) {{-- The $result variable is passed from the controller --}}
            <h1 class="text-3xl sm:text-4xl md:text-4xl font-extrabold text-gray-900 tracking-tight text-center mb-8">
                Hasil Analisis <span class="text-blue-600">Mood Anda</span>
            </h1>

            {{-- Kartu Utama Hasil Mood (Chart, Sticker, Mood Type) --}}
            <div class="bg-white p-6 sm:p-8 rounded-2xl border border-gray-200 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 md:gap-x-12 items-center justify-items-center">
                    {{-- SVG Chart --}}
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

                    {{-- Mood Sticker & Basic Mood Text --}}
                    <div class="flex flex-col items-center text-center">
                        <div class="w-40 h-40 relative flex items-center justify-center bg-blue-50 rounded-2xl border-4 border-blue-100 p-2 shadow-sm">
                            <img src="{{ $moodImage }}" alt="Sticker {{ $moodText }}" class="w-full h-full object-contain" />
                        </div>
                        <p class="text-xl font-bold text-blue-600 mt-6 mb-4">
                            Mood Anda saat ini: <span class="font-extrabold">{{ $moodText }}</span>
                        </p>

                        {{-- PA/NA Legend (Existing) --}}
                        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-6 text-sm text-gray-600 mt-4">
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


            {{-- NEW: Container for Side-by-Side Explanation and Scores/Tips --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8 mb-8">

                {{-- LEFT CARD: Detailed Mood Explanation --}}
                <div class="bg-white p-6 sm:p-8 rounded-2xl border border-gray-200">
                    <h2 class="text-2xl font-bold mb-4 text-gray-900 text-center">Apa Arti Mood Anda Ini?</h2>
                    <p class="text-gray-700 text-base leading-relaxed text-center">
                        {{ $moodExplanation }}
                    </p>
                </div>

                {{-- RIGHT CARD: PA/NA Scores, Scale, and Tip --}}
                <div class="bg-white p-6 sm:p-8 rounded-2xl border border-gray-200">
                    <h2 class="text-2xl font-bold mb-4 text-gray-900 text-center">Detail Skor & Saran</h2>
                    <div class="text-base text-gray-600 space-y-3">
                        <p><strong class="text-blue-700">PA (Positive Affect):</strong> {{ $pa }} / 50, <span class="italic">{{ $paInterpretation }}</span></p>
                        <p><strong class="text-gray-700">NA (Negative Affect):</strong> {{ $na }} / 50, <span class="italic">{{ $naInterpretation }}</span></p>
                        <p class="text-xs text-gray-500">*Skor PA dan NA diukur dari 10 (sangat rendah) hingga 50 (sangat tinggi).</p>
                        <p class="text-base italic text-gray-700 mt-4">
                            <span class="font-semibold text-blue-600">Tip untuk Anda:</span> {{ $moodTip }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Kartu Rekomendasi Musik (Existing) --}}
            <div class="bg-white p-6 sm:p-8 rounded-2xl border border-gray-200 mt-8">
                <h2 class="text-2xl font-bold mb-4 text-gray-900 text-center">Playlist Rekomendasi untuk Anda</h2>
                <p class="text-center text-gray-600 mb-6 text-sm">Berdasarkan analisis mood Anda, berikut adalah beberapa lagu yang mungkin cocok:</p>

                @if($recommendedSongs->isNotEmpty())
                    <div class="space-y-3">
                        @foreach($recommendedSongs as $song)
                            <a href="{{ $song->url }}" target="_blank" class="block bg-gray-50 rounded-lg p-3 flex items-center justify-between border border-gray-200 hover:bg-gray-100 transition duration-200">
                                <div class="flex-1 min-w-0 pr-4">
                                    <p class="font-semibold text-gray-900 truncate" title="{{ $song->title }}">{{ $song->title }}</p>
                                    <p class="text-sm text-gray-600 truncate" title="{{ $song->artist }}">oleh {{ $song->artist }}</p>
                                </div>
                                {{-- SVG Icon Play --}}
                                <div class="text-blue-500 hover:text-blue-700 flex-shrink-0" style="width: 28px; height: 28px;">
                                    <svg viewBox="0 0 512 512" style="fill: currentColor;">
                                        <g>
                                            <path d="M256,0C114.625,0,0,114.625,0,256c0,141.374,114.625,256,256,256c141.374,0,256-114.626,256-256
                                            C512,114.625,397.374,0,256,0z M351.062,258.898l-144,85.945c-1.031,0.626-2.344,0.657-3.406,0.031
                                            c-1.031-0.594-1.687-1.702-1.687-2.937v-85.946v-85.946c0-1.218,0.656-2.343,1.687-2.938c1.062-0.609,2.375-0.578,3.406,0.031
                                            l144,85.962c1.031,0.586,1.641,1.718,1.641,2.89C352.703,257.187,352.094,258.297,351.062,258.898z"/>
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
            <div class="bg-white p-8 rounded-2xl border border-gray-200 text-center py-20">
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