@extends('layouts.app')

@section('content')
{{-- Kontainer utama dengan latar belakang abu-abu sangat lembut (mengikuti style panas.result) --}}
<section class="bg-gray-50 py-12 sm:py-16 min-h-screen flex flex-col justify-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 w-full">

        {{-- Perlu diperhatikan: Di sini tidak ada session('success') karena ini halaman detail, bukan hasil langsung setelah submit --}}

        {{-- !!! PENTING: Hapus blok PHP berikut dari sini, karena variabel sudah diteruskan dari Controller !!! --}}
        {{-- @php
            use App\Models\PanasResult;
            use App\Models\MoodSong;

            $result = PanasResult::where('user_id', auth()->id())->latest()->first(); // <-- Ini TIDAK DIBUTUHKAN DI SINI
            // ... semua perhitungan PA, NA, moodText, moodImage, recommendedSongs ...
        @endphp --}}
        {{-- Variabel ($result, $pa, $na, $moodText, $moodImage, $recommendedSongs, dll)
             akan tersedia secara otomatis karena sudah di-compact dari PanasController@showResultDetail. --}}


        @if($result) {{-- Pastikan $result ada (Controller harus menjamin ini dengan findOrFail) --}}
            <h1 class="text-3xl sm:text-4xl md:text-4xl font-extrabold text-gray-900 tracking-tight text-center mb-8">
                Detail Hasil Kuesioner <span class="text-blue-600">Anda</span>
            </h1>
            <p class="text-base sm:text-lg text-center text-gray-600 mb-8 max-w-2xl mx-auto">
                Ini adalah analisis rinci dari kuesioner Anda yang diisi pada tanggal
                <span class="font-semibold">{{ $result->created_at->isoFormat('DD MMMM YYYY [pukul] HH:mm') }} WIB</span>.
            </p>

            {{-- Kartu Utama Hasil Mood (sama persis dengan panas.result) --}}
            <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-lg border border-gray-200 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 md:gap-x-12 items-center justify-items-center">
                    {{-- Diagram Lingkaran PA/NA --}}
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

                    {{-- Gambar Mood dan Detail --}}
                    <div class="flex flex-col items-center text-center">
                        <div class="w-40 h-40 relative flex items-center justify-center bg-blue-50 rounded-2xl border-4 border-blue-100 p-2 shadow-sm">
                            <img src="{{ $moodImage }}" alt="Sticker {{ $moodText }}" class="w-full h-full object-contain" />
                        </div>
                        <p class="text-xl font-bold text-blue-600 mt-6 mb-4">
                            Mood saat itu: <span class="font-extrabold">{{ $moodText }}</span>
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

            {{-- Kartu Rekomendasi Musik (sama persis dengan panas.result) --}}
            <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-lg border border-gray-200 mt-8">
                <h2 class="text-2xl font-bold mb-6 text-gray-900 text-center">🎶 Playlist Rekomendasi untuk Mood Ini 🎶</h2>

                @if($recommendedSongs->isNotEmpty())
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 justify-center">
                        @foreach($recommendedSongs as $song)
                            <a href="{{ $song->url }}" target="_blank" class="block bg-white rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition transform hover:-translate-y-0.5 group overflow-hidden">
                                <div class="relative">
                                    @if($song->album_cover)
                                        <img src="{{ $song->album_cover }}" alt="Cover {{ $song->title }}" class="w-full h-28 object-cover rounded-t-xl">
                                    @else
                                        <div class="w-full h-28 bg-gray-100 flex items-center justify-center text-gray-400 text-xs rounded-t-xl">
                                            🎶 No Image
                                        </div>
                                    @endif
                                    {{-- Play overlay --}}
                                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 rounded-t-xl">
                                        <span class="text-white text-2xl">▶️</span>
                                    </div>
                                </div>
                                <div class="p-3 text-center">
                                    <p class="font-semibold text-gray-800 text-sm mb-0.5 truncate" title="{{ $song->title }}">{{ $song->title }}</p>
                                    <p class="text-gray-600 text-xs truncate" title="{{ $song->artist }}">oleh {{ $song->artist }}</p>
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
            {{-- Pesan fallback jika $result tidak ada (seharusnya tidak tercapai dengan findOrFail di controller) --}}
            <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-200 text-center py-20">
                <p class="text-gray-600 italic text-xl">Hasil kuesioner tidak ditemukan untuk ID ini.</p>
            </div>
        @endif

        {{-- Tombol aksi di bagian bawah --}}
        <div class="mt-12 text-center">
            <a href="{{ route('panas.history') }}" class="inline-flex items-center bg-gray-600 text-white px-7 py-3 rounded-full text-base font-semibold hover:bg-gray-700 transition duration-300 shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8m-9 1a9 9 0 110-18 9 9 0 010 18z"></path></svg>
                Kembali ke Riwayat
            </a>
            <p class="mt-4 text-sm text-gray-500">
                Isi kuesioner baru? <a href="{{ route('panas.show') }}" class="text-blue-600 hover:underline font-medium">Klik di sini</a>
            </p>
        </div>

    </div>
</section>
@endsection

{{-- Pastikan @push('styles') ada di layouts/app.blade.php Anda --}}
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