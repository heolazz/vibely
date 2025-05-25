@extends('layouts.app')

@section('content')
@if(Auth::user()->role == 'admin')
    @php
        header("Location: " . route('admin.dashboard'));
        exit;
    @endphp
@else

<!-- Hero Section -->
<section class="bg-gradient-to-br from-white to-gray-100 py-14 sm:py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 text-center">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-900 tracking-tight">
            Selamat datang di <span class="text-indigo-600">Vibely</span>
        </h1>
        <p class="mt-4 text-base sm:text-lg text-gray-700 max-w-2xl mx-auto">
            Dukung kesehatan mentalmu dengan fitur reflektif dan konten yang menenangkan.
        </p>

        <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
            <div class="bg-white p-6 rounded-2xl text-center shadow hover:shadow-md transition duration-300 border border-gray-200">
                <img src="{{ asset('icons/icon-journal.png') }}" alt="Jurnal Emosi" class="mx-auto w-10 h-10">
                <h3 class="font-semibold text-lg text-gray-900 mt-4">Jurnal Emosi</h3>
                <p class="text-gray-600 text-sm mt-2">Refleksikan perasaanmu setiap hari untuk mengenal diri lebih dalam.</p>
            </div>
            <div class="bg-white p-6 rounded-2xl text-center shadow hover:shadow-md transition duration-300 border border-gray-200">
                <img src="{{ asset('icons/icon-music.png') }}" alt="Rekomendasi Musik" class="mx-auto w-10 h-10">
                <h3 class="font-semibold text-lg text-gray-900 mt-4">Rekomendasi Musik</h3>
                <p class="text-gray-600 text-sm mt-2">Temukan musik sesuai suasana hatimu untuk menenangkan atau menyemangati hari.</p>
            </div>
            <div class="bg-white p-6 rounded-2xl text-center shadow hover:shadow-md transition duration-300 border border-gray-200">
                <img src="{{ asset('icons/icon-education.png') }}" alt="Edukasi Mental Health" class="mx-auto w-10 h-10">
                <h3 class="font-semibold text-lg text-gray-900 mt-4">Edukasi Mental Health</h3>
                <p class="text-gray-600 text-sm mt-2">Pelajari cara menjaga pikiran tetap sehat dengan konten berkualitas.</p>
            </div>
        </div>
    </div>
</section>

<!-- Welcome Tools -->
<section class="bg-white py-12 sm:py-16">
    <div class="max-w-5xl mx-auto px-4 text-center">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Hai, {{ Auth::user()->name }} 👋</h2>
        <p class="text-base sm:text-lg text-gray-600 mt-2">
            Senang melihatmu kembali. Yuk rawat suasana hatimu hari ini bersama <span class="font-semibold text-indigo-600">Vibely</span>.
        </p>
        <blockquote class="italic text-gray-500 mt-6 max-w-xl mx-auto text-sm sm:text-base">
            "Kesehatan mental bukan tujuan, tapi proses. Ini tentang bagaimana kamu mengemudikan, bukan ke mana kamu pergi."
        </blockquote>
    </div>

    <div class="mt-10 grid grid-cols-1 gap-4 sm:grid-cols-2 max-w-5xl mx-auto px-4">
        @php
            $tools = [
                ['icon' => asset('icons/icon-kuesioner.png'), 'title' => 'Isi Kuesioner PANAS', 'desc' => 'Nilai mood kamu hari ini dengan 20 pertanyaan sederhana dan reflektif.', 'route' => route('panas.show')],
                ['icon' => asset('icons/icon-new.png'), 'title' => 'Hasil Terbaru', 'desc' => 'Lihat skor PA, NA, dan interpretasi suasana hatimu secara instan.', 'route' => route('panas.result')],
                ['icon' => asset('icons/icon-history.png'), 'title' => 'Riwayat Kuesioner', 'desc' => 'Lihat perkembangan mood kamu dari waktu ke waktu.', 'route' => route('panas.history')],
                ['icon' => asset('icons/icon-music.png'), 'title' => 'Rekomendasi Musik', 'desc' => 'Temukan musik yang cocok untuk menenangkan atau menyemangati harimu.', 'route' => route('rekomendasi')],
            ];
        @endphp

        @foreach ($tools as $tool)
        <a href="{{ $tool['route'] }}" class="block bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-2xl p-5 sm:p-6 shadow-sm hover:shadow-md hover:scale-[1.02] transition duration-300">
            <div class="flex items-start gap-3 mb-3">
                <img src="{{ $tool['icon'] }}" alt="{{ $tool['title'] }}" class="w-6 h-6 mt-1">
                <h2 class="text-base sm:text-xl font-semibold text-gray-800">{{ $tool['title'] }}</h2>
            </div>
            <p class="text-sm sm:text-base text-gray-600">{{ $tool['desc'] }}</p>
        </a>
        @endforeach
    </div>
</section>



<!-- Artikel Section -->
<section class="bg-gray-20 py-4 pb-14">
    <div class="container mx-auto px-4 max-w-6xl mt-16">
    <h2 class="text-3xl font-bold text-center text-black dark:text-white mb-10">Artikel Seputar Kesehatan Mental</h2>
    <div class="grid md:grid-cols-3 gap-8">
      @foreach ($articles as $article)
        <a href="{{ route('artikel.show', $article->id) }}" class="bg-gray-50 dark:bg-gray-900 rounded-xl shadow-md hover:shadow-lg transition p-6 block">
          <h3 class="font-semibold text-lg mb-2 text-black dark:text-white">{{ $article->title }}</h3>
          <p class="text-sm text-gray-600 dark:text-gray-400">{{ $article->excerpt }}</p>
        </a>
      @endforeach
    </div>
</div>

</section>

@endif
@endsection
