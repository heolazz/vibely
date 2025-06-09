<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Vibely – Kesehatan Mentalmu Penting</title>
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans text-black">

<!-- Wrapper HEADER + HERO -->
<div class="relative">
    <!-- Background Image with Gradient Overlay -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat z-0"
         style="background-image: linear-gradient(to bottom, rgba(255,255,255,0) 40%, rgba(255,255,255,1) 90%), url('{{ asset('images/bg-home2.png') }}');">
    </div>

    <!-- Content -->
    <div class="relative z-10">

        <!-- Header -->
        <header class="shadow py-4 px-4 sticky top-0 z-20 bg-white">
            <div class="container mx-auto flex justify-between items-center px-4">
                <h1 class="text-xl font-bold text-black">Vibely</h1>
                <div class="space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-black hover:underline">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-black hover:underline">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-black text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-gray-800 transition">Daftar</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="min-h-screen flex flex-col items-center justify-center px-4 text-center -mt-10 py-20">
            <div class="bg-white border border-gray-200 rounded-3xl p-10 max-w-4xl text-center shadow-xl">
                <h2 class="text-5xl font-extrabold mb-6 text-black">Kesehatan Mentalmu Berharga</h2>
                <p class="text-lg text-gray-700 mb-6">Kelola emosimu, catat suasana hatimu, dan temukan musik yang menenangkan jiwamu.</p>
                <div class="flex justify-center gap-4 mb-8">
                    <a href="{{ route('login') }}" class="bg-black text-white px-6 py-3 rounded-full font-semibold hover:bg-gray-800 transition">Masuk</a>
                    <a href="#artikel" class="border border-black text-black px-6 py-3 rounded-full font-semibold hover:bg-gray-100 transition">Jelajahi</a>
                </div>

<div class="grid md:grid-cols-4  gap-4">
    <div class="bg-gray-50 p-3 rounded-xl shadow flex flex-col items-center text-center">
        <img src="{{ asset('icons/icon-journal.png') }}" alt="Jurnal Emosi Icon" class="w-12 h-12 mb-2">
        <h3 class="text-lg font-semibold text-black mb-1">Jurnal Emosi</h3>
        <p class="text-gray-600 text-sm">Catat perasaan dan pikiranmu setiap hari untuk pemahaman yang lebih baik.</p>
    </div>
    <div class="bg-gray-50 p-3 rounded-xl shadow flex flex-col items-center text-center">
        <img src="{{ asset('icons/icon-kuesioner.png') }}" alt="Pelacak Mood Icon" class="w-12 h-12 mb-2">
        <h3 class="text-lg font-semibold text-black mb-1">Pelacak Mood Mingguan</h3>
        <p class="text-gray-600 text-sm">Pantau perubahan suasana hati mingguanmu dengan kuesioner singkat.</p>
    </div>
    <div class="bg-gray-50 p-3 rounded-xl shadow flex flex-col items-center text-center">
        <img src="{{ asset('icons/icon-music.png') }}" alt="Rekomendasi Musik Icon" class="w-12 h-12 mb-2">
        <h3 class="text-lg font-semibold text-black mb-1">Rekomendasi Musik</h3>
        <p class="text-gray-600 text-sm">Temukan musik yang sesuai dengan moodmu untuk meningkatkan suasana hati.</p>
    </div>
    <div class="bg-gray-50 p-3 rounded-xl shadow flex flex-col items-center text-center">
        <img src="{{ asset('icons/icon-education.png') }}" alt="Konten Edukasi Icon" class="w-12 h-12 mb-2">
        <h3 class="text-lg font-semibold text-black mb-1">Konten Edukasi</h3>
        <p class="text-gray-600 text-sm">Akses artikel dan sumber daya untuk memperdalam pemahaman kesehatan mentalmu.</p>
    </div>
</div>
            </div>
        </section>
    </div>
</div>

<!-- Section Edukasi Mental Health -->
<section class="bg-white dark:bg-black py-16 px-6 md:px-12 max-w-7xl mx-auto">
  <h2 class="text-4xl font-bold text-center text-black dark:text-white mb-12">Edukasi Kesehatan Mental</h2>

  <div class="space-y-20 max-w-4xl mx-auto">

    <!-- 1. Apa itu Kesehatan Mental? -->
    <div class="flex flex-col md:flex-row items-center gap-8">
      <div class="md:w-1/2 text-center md:text-left">
        <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-3">Apa itu Kesehatan Mental?</h3>
        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
          Kesehatan mental adalah kondisi kesejahteraan emosi dan pikiran. Sama pentingnya seperti kesehatan fisik, kesehatan mental memengaruhi cara kita berpikir, merasa, dan bertindak.
        </p>
      </div>
<div class="mt-6 flex justify-center">
  <iframe width="420" height="180" src="https://www.youtube.com/embed/oxx564hMBUI?si=WJyjrTX4dGPjifzl" 
    title="Edukasi Kesehatan Mental" frameborder="0" 
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
    allowfullscreen class="rounded-lg shadow-md">
  </iframe>
</div>
    </div>

<!-- 2. Kenapa Kita Harus Mengenali Emosi? -->
<div class="flex flex-col md:flex-row items-center gap-8">
  <!-- Kartu Emosi -->
  <div class="md:w-1/2 order-2 md:order-1 grid grid-cols-2 gap-4">
    <!-- Emosi: Marah -->
    <div class="bg-gray-100 rounded-lg p-6 shadow hover:shadow-lg transition cursor-pointer">
      <h4 class="text-xl font-semibold text-[#252525] mb-2">😠 Marah</h4>
      <p class="text-gray-700 text-sm">Bisa muncul karena stres atau tekanan.</p>
    </div>
    <!-- Emosi: Sedih -->
    <div class="bg-gray-100 rounded-lg p-6 shadow hover:shadow-lg transition cursor-pointer">
      <h4 class="text-xl font-semibold text-[#252525] mb-2">😢 Sedih</h4>
      <p class="text-gray-700 text-sm">Mungkin karena kehilangan sesuatu yang berharga.</p>
    </div>
    <!-- Emosi: Senang -->
    <div class="bg-gray-100 rounded-lg p-6 shadow hover:shadow-lg transition cursor-pointer">
      <h4 class="text-xl font-semibold text-[#252525] mb-2">😊 Senang</h4>
      <p class="text-gray-700 text-sm">Datang dari hal-hal sederhana yang membuat hati bahagia.</p>
    </div>
    <!-- Emosi: Takut -->
    <div class="bg-gray-100 rounded-lg p-6 shadow hover:shadow-lg transition cursor-pointer">
      <h4 class="text-xl font-semibold text-[#252525] mb-2">😨 Takut</h4>
      <p class="text-gray-700 text-sm">Biasanya muncul saat menghadapi hal yang tidak pasti.</p>
    </div>
  </div>

  <!-- Penjelasan -->
  <div class="md:w-1/2 order-1 md:order-2 text-center md:text-left">
    <h3 class="text-2xl font-semibold text-[#252525] mb-3">Kenapa Kita Harus Mengenali Emosi?</h3>
    <p class="text-gray-600 leading-relaxed">
      Mengenali emosi bukan berarti lemah — justru ini adalah kekuatan. Dengan mengenali apa yang kita rasakan, kita bisa lebih sadar akan diri sendiri dan mengambil keputusan yang lebih sehat.
    </p>
  </div>
</div>



<!-- 3. Musik sebagai Terapi Emosi (playlist dihapus) -->
<div class="flex flex-col md:flex-row items-center gap-8">
  <div class="md:w-1/2 text-center md:text-left">
    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-3">Musik sebagai Terapi Emosi</h3>
    <p class="text-gray-600 dark:text-gray-300 leading-relaxed mb-4">
      Musik dapat menjadi teman yang memahami. Saat kita cemas, sedih, atau lelah, musik bisa membantu menenangkan pikiran dan memperbaiki suasana hati.
    </p>
  </div>
  <div class="md:w-1/2 flex justify-center">
    <iframe width="420" height="180" src="https://www.youtube.com/embed/UjhgHEDG0NU?si=P_RkwFs-oqmcEj3V" 
      title="Music Therapy Video" frameborder="0" 
      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
      allowfullscreen class="rounded-lg shadow-md">
    </iframe>
  </div>
</div>


    <!-- 4. Yuk Mulai Perjalanan Emosimu -->
    <div class="text-center max-w-2xl mx-auto">
      <h3 class="text-3xl font-bold text-black dark:text-white mb-6">Yuk Mulai Perjalanan Emosimu</h3>
      <p class="text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
        Sudah saatnya kamu mengenali emosimu. Tulis jurnal harian, temukan rekomendasi musik, dan rawat kesehatan mentalmu mulai sekarang.
      </p>
      <a href="{{ route('register') }}" class="inline-block bg-black text-white px-8 py-3 rounded-full font-semibold hover:bg-gray-800 transition">
        🌿 Mulai Sekarang
      </a>
    </div>
  </div>
</section>

<section id="artikel" class="py-16 bg-white dark:bg-black">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-3xl font-bold text-black dark:text-white">
                Artikel Seputar Kesehatan Mental
            </h2>
            <a href="{{ route('artikel.index') }}" class="text-blue-600 hover:underline font-semibold hidden md:block">
                Lihat Semua →
            </a>
        </div>
        
        <div class="flex items-center gap-2 md:gap-4">
            <button id="slider-prev-btn" class="flex-shrink-0 bg-white p-2 rounded-full shadow-md hover:bg-gray-100 transition disabled:opacity-50 disabled:cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div id="slider-viewport" class="overflow-hidden flex-1">
                {{-- PERBAIKAN: Menambahkan 'gap-4' untuk jarak antar kartu --}}
                <div id="slider-track" class="flex transition-transform duration-500 ease-in-out gap-4">
                    @forelse ($articles as $article)
                        {{-- PERBAIKAN: Menghapus 'px-2' dari kartu --}}
                        <div class="flex-none w-full md:w-1/2 lg:w-1/3">
                            <a href="{{ route('artikel.show', $article->id) }}" class="block h-full">
                                <div class="bg-gray-50 dark:bg-gray-900 rounded-xl shadow-md hover:shadow-lg transition p-6 h-full flex flex-col">
                                    <h3 class="font-semibold text-lg mb-2 text-black dark:text-white">{{ $article->title }}</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 flex-grow">{{ $article->excerpt }}</p>
                                </div>
                            </a>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 w-full">Belum ada artikel yang tersedia.</p>
                    @endforelse
                </div>
            </div>

            <button id="slider-next-btn" class="flex-shrink-0 bg-white p-2 rounded-full shadow-md hover:bg-gray-100 transition disabled:opacity-50 disabled:cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <div class="text-center mt-8 md:hidden">
            <a href="{{ route('artikel.index') }}" class="text-blue-600 hover:underline font-semibold">
                Lihat Semua Artikel →
            </a>
        </div>
    </div>
</section>

{{-- Kode JavaScript untuk Slider --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const track = document.getElementById('slider-track');
    const prevBtn = document.getElementById('slider-prev-btn');
    const nextBtn = document.getElementById('slider-next-btn');
    
    if (!track || !prevBtn || !nextBtn) return;

    const cards = track.children;
    if (cards.length === 0) {
        prevBtn.style.display = 'none';
        nextBtn.style.display = 'none';
        return;
    }

    let currentIndex = 0;
    
    function updateSlider() {
        if (cards.length === 0) return;

        // PERBAIKAN: Dapatkan nilai 'gap' langsung dari CSS
        const gap = parseFloat(getComputedStyle(track).gap) || 0;
        const cardWidth = cards[0].offsetWidth;
        
        // Jarak geser sekarang adalah lebar kartu DITAMBAH jarak gap
        const slideDistance = cardWidth + gap;
        
        // Geser track slider dengan kalkulasi yang akurat
        track.style.transform = `translateX(-${currentIndex * slideDistance}px)`;

        // Logika untuk menonaktifkan tombol tetap sama
        const viewportWidth = track.parentElement.offsetWidth;
        const visibleCards = Math.round((viewportWidth + gap) / (cardWidth + gap));
        
        prevBtn.disabled = (currentIndex === 0);
        nextBtn.disabled = (currentIndex >= cards.length - visibleCards);
    }

    nextBtn.addEventListener('click', () => {
        currentIndex++;
        updateSlider();
    });

    prevBtn.addEventListener('click', () => {
        currentIndex--;
        updateSlider();
    });

    window.addEventListener('resize', updateSlider);

    updateSlider();
});
</script>
</script>

<section class="py-20 bg-white dark:bg-black text-center text-black dark:text-white">
  <div class="container mx-auto px-4 max-w-4xl">
    <h2 class="text-3xl font-bold mb-4">Mulai Perjalananmu Menjaga Kesehatan Mental Hari Ini</h2>
    <p class="mb-6 text-lg">Gabung bersama pengguna lain yang telah merasa lebih baik bersama Vibely 🌱</p>
    <a href="{{ route('register') }}" class="bg-black text-white font-semibold px-6 py-3 rounded-full hover:bg-gray-800 transition">Daftar Sekarang</a>
  </div>
</section>

<footer class="bg-white dark:bg-black py-6 text-center text-sm text-gray-500 dark:text-gray-400">
  <p>© {{ date('Y') }} Vibely – Karena perasaanmu penting 🌻</p>
</footer>


</body>
</html>
