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

<div class="relative">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat z-0"
         style="background-image: linear-gradient(to bottom, rgba(255,255,255,0) 40%, rgba(255,255,255,1) 90%), url('{{ asset('images/bg-home2.png') }}');">
    </div>

    <div class="relative z-10">

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

        {{-- Hero Section --}}
        <section class="min-h-screen bg-white text-[#252525] flex items-center px-10 py-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                {{-- Kiri: Teks --}}
                <div class="space-y-6">
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                        Kesehatan Mentalmu Berharga 💙
                    </h1>
                    <p class="text-lg">
                        Kelola emosimu, catat suasana hatimu, dan temukan musik yang menenangkan jiwamu.
                    </p>
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" class="bg-[#252525] text-white px-6 py-3 rounded-xl hover:opacity-90 transition">Masuk</a>
                        <a href="{{ route('register') }}" class="border border-[#252525] text-[#252525] px-6 py-3 rounded-xl hover:bg-[#252525] hover:text-white transition">Daftar</a>
                    </div>
                </div>

                {{-- Kanan: Gambar --}}
                <div class="flex justify-center">
                    <img src="{{ asset('images/landingpage-hero.png') }}" alt="Hero Image" class="max-w-full h-auto">
                </div>
            </div>
        </section>
    </div>
</div>

{{-- Section Fitur --}}
<section class="bg-[#252525] text-white px-10 py-20">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-semibold">Fitur Unggulan Vibely</h2>
        <p class="text-lg mt-2">Dibuat khusus untuk mendukung kesejahteraan emosimu</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        {{-- Fitur 1 --}}
        <div class="bg-[#333] rounded-2xl p-6 text-center shadow-lg">
            <img src="{{ asset('icons/icon-journal.png') }}" alt="Jurnal Emosi" class="mx-auto w-16 h-16 mb-4">
            <h3 class="text-xl font-semibold mb-2">Jurnal Emosi</h3>
            <p class="text-sm">Catat perasaan dan pikiranmu setiap hari untuk pemahaman yang lebih baik.</p>
        </div>

        {{-- Fitur 2 --}}
        <div class="bg-[#333] rounded-2xl p-6 text-center shadow-lg">
            <img src="{{ asset('icons/icon-kuesioner.png') }}" alt="Pelacak Mood" class="mx-auto w-16 h-16 mb-4">
            <h3 class="text-xl font-semibold mb-2">Pelacak Mood</h3>
            <p class="text-sm">Pantau perubahan suasana hati dan temukan pola emosionalmu.</p>
        </div>

        {{-- Fitur 3 --}}
        <div class="bg-[#333] rounded-2xl p-6 text-center shadow-lg">
            <img src="{{ asset('icons/icon-music.png') }}" alt="Rekomendasi Musik" class="mx-auto w-16 h-16 mb-4">
            <h3 class="text-xl font-semibold mb-2">Rekomendasi Musik</h3>
            <p class="text-sm">Temukan musik yang sesuai dengan moodmu untuk meningkatkan suasana hati.</p>
        </div>
    </div>
</section>

<section class="bg-white dark:bg-black py-16 px-6 md:px-12 max-w-7xl mx-auto">
  <h2 class="text-4xl font-bold text-center text-black dark:text-white mb-12">Edukasi Kesehatan Mental</h2>

  <div class="space-y-20 max-w-4xl mx-auto">

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

<div class="flex flex-col md:flex-row items-center gap-8">
  <div class="md:w-1/2 order-2 md:order-1 grid grid-cols-2 gap-4">
    <div class="bg-gray-100 rounded-lg p-6 shadow hover:shadow-lg transition cursor-pointer">
      <h4 class="text-xl font-semibold text-[#252525] mb-2">😠 Marah</h4>
      <p class="text-gray-700 text-sm">Bisa muncul karena stres atau tekanan.</p>
    </div>
    <div class="bg-gray-100 rounded-lg p-6 shadow hover:shadow-lg transition cursor-pointer">
      <h4 class="text-xl font-semibold text-[#252525] mb-2">😢 Sedih</h4>
      <p class="text-gray-700 text-sm">Mungkin karena kehilangan sesuatu yang berharga.</p>
    </div>
    <div class="bg-gray-100 rounded-lg p-6 shadow hover:shadow-lg transition cursor-pointer">
      <h4 class="text-xl font-semibold text-[#252525] mb-2">😊 Senang</h4>
      <p class="text-gray-700 text-sm">Datang dari hal-hal sederhana yang membuat hati bahagia.</p>
    </div>
    <div class="bg-gray-100 rounded-lg p-6 shadow hover:shadow-lg transition cursor-pointer">
      <h4 class="text-xl font-semibold text-[#252525] mb-2">😨 Takut</h4>
      <p class="text-gray-700 text-sm">Biasanya muncul saat menghadapi hal yang tidak pasti.</p>
    </div>
  </div>

  <div class="md:w-1/2 order-1 md:order-2 text-center md:text-left">
    <h3 class="text-2xl font-semibold text-[#252525] mb-3">Kenapa Kita Harus Mengenali Emosi?</h3>
    <p class="text-gray-600 leading-relaxed">
      Mengenali emosi bukan berarti lemah — justru ini adalah kekuatan. Dengan mengenali apa yang kita rasakan, kita bisa lebih sadar akan diri sendiri dan mengambil keputusan yang lebih sehat.
    </p>
  </div>
</div>



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



<script>
  document.addEventListener('DOMContentLoaded', function () {
    const slider = document.getElementById('emotionSlider');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const slidesCount = slider.children.length;
    let currentIndex = 0;

    function updateSlider() {
      slider.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    prevBtn.addEventListener('click', () => {
      currentIndex = (currentIndex - 1 + slidesCount) % slidesCount;
      updateSlider();
    });

    nextBtn.addEventListener('click', () => {
      currentIndex = (currentIndex + 1) % slidesCount;
      updateSlider();
    });
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const slider = document.getElementById('emotionSlider');
    let currentIndex = 0;
    const slidesCount = slider.children.length;

    slider.addEventListener('click', () => {
      currentIndex = (currentIndex + 1) % slidesCount;
      slider.style.transform = `translateX(-${currentIndex * 100}%)`;
    });
  });
</script>

</body>
</html>