<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Vibely – Kesehatan Mentalmu Penting</title>
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Custom styles for primary blue color and button shapes */
        .btn-primary {
            background-color: #3B82F6; /* Tailwind blue-500 */
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px; /* Fully rounded */
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #2563EB; /* Tailwind blue-600 */
        }
        .btn-outline-primary {
            border: 2px solid #3B82F6; /* Tailwind blue-500 */
            color: #3B82F6;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px; /* Fully rounded */
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-outline-primary:hover {
            background-color: #3B82F6;
            color: white;
        }
        .text-primary-accent {
            color: #3B82F6; /* Tailwind blue-500 for accent text */
        }
    </style>
</head>
<body class="bg-white font-sans text-black">

    <div class="min-h-screen bg-gray-50 flex flex-col">

        <header class="py-4 sticky px-4 top-0 z-20 bg-white shadow-md">
            <div class="container mx-auto flex justify-between items-center px-4">
                <h1 class="text-xl font-semibold text-gray-900 md:text-2xl md:font-bold">Vibely</h1>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:underline text-sm md:text-base">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-primary px-4 py-2 text-xs sm:px-5 sm:py-2 sm:text-sm">Masuk</a>
                        @endauth
                    @endif
                </div>
            </div>
        </header>

        {{-- Hero Section (Menggunakan Grid) --}}
        <section class="flex-grow flex items-center justify-center py-12 md:py-20 bg-gradient-to-br from-white to-blue-50">
            <div class="container mx-auto max-w-6xl grid grid-cols-1 lg:grid-cols-2 items-center gap-8 lg:gap-16 px-4 text-center lg:text-left">
                {{-- Left Column (Text Content) --}}
                <div class="pt-10 lg:pt-0 order-2 lg:order-1">
                    <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4 md:mb-6 leading-tight text-gray-900">
                        Kelola Kesehatan Mentalmu,<br>Kapan Saja, Di Mana Saja<br><span class="text-primary-accent">dengan Vibely</span>
                    </h2>
                    <p class="text-base md:text-lg text-gray-700 mb-6 md:mb-8 max-w-xl mx-auto lg:max-w-none lg:mx-0">
                        Vibely hadir untuk membantu Anda menjaga kesejahteraan emosional melalui jurnal harian, pelacak mood, dan rekomendasi musik menenangkan.
                    </p>
                    <div class="flex justify-center lg:justify-start gap-3 md:gap-4 flex-col sm:flex-row">
                        <a href="{{ route('register') }}" class="btn-primary w-full sm:w-auto">Mulai Perjalananmu</a>
                        <a href="#fitur" class="btn-outline-primary w-full sm:w-auto">Jelajahi Fitur</a>
                    </div>
                </div>

                {{-- Right Column (Image and Decorative Elements) --}}
                <div class="flex justify-center items-center relative mt-8 lg:mt-0 order-1 lg:order-2">
                    <img src="{{ asset('images/landingpage-hero.png') }}" alt="Vibely App Screenshot" class="max-w-full h-auto rounded-lg translate-y-0 md:translate-y-8">
                    <div class="absolute top-0 right-4 md:right-10 w-3 h-3 md:w-4 md:h-4 bg-blue-200 rounded-full opacity-50"></div>
                    <div class="absolute bottom-2 left-2 md:bottom-5 md:left-5 w-2 h-2 md:w-3 md:h-3 bg-indigo-200 rounded-full opacity-50"></div>
                </div>
            </div>
        </section>

        {{-- Fitur Section --}}
        <section id="fitur" class="py-10 md:py-16 bg-white">
            <div class="container mx-auto max-w-6xl px-4">
                <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-4">Kenapa Anda Harus Memilih Vibely?</h2>
                <p class="text-base md:text-lg text-gray-600 text-center mb-8 md:mb-12">Dapatkan informasi lebih lanjut tentang kami.</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    <div class="bg-gray-50 p-5 md:p-6 rounded-lg shadow-sm flex flex-col items-center text-center hover:shadow-md transition duration-300">
                        <img src="{{ asset('icons/icon-journal.png') }}" alt="Jurnal Emosi Icon" class="mb-3 w-14 h-14 md:mb-4 md:w-16 md:h-16 object-contain">
                        <h3 class="text-lg md:text-xl font-semibold text-gray-900 mb-1 md:mb-2">Jurnal Emosi</h3>
                        <p class="text-sm text-gray-600">Catat perasaan dan pikiranmu setiap hari untuk pemahaman yang lebih baik tentang diri.</p>
                    </div>

                    <div class="bg-gray-50 p-5 md:p-6 rounded-lg shadow-sm flex flex-col items-center text-center hover:shadow-md transition duration-300">
                        <img src="{{ asset('icons/icon-kuesioner.png') }}" alt="Pelacak Mood Icon" class="mb-3 w-14 h-14 md:mb-4 md:w-16 md:h-16 object-contain">
                        <h3 class="text-lg md:text-xl font-semibold text-gray-900 mb-1 md:mb-2">Pelacak Mood</h3>
                        <p class="text-sm text-gray-600">Pantau perubahan suasana hati dari waktu ke waktu dan temukan pola emosionalmu.</p>
                    </div>

                    <div class="bg-gray-50 p-5 md:p-6 rounded-lg shadow-sm flex flex-col items-center text-center hover:shadow-md transition duration-300">
                        <img src="{{ asset('icons/icon-music.png') }}" alt="Rekomendasi Musik Icon" class="mb-3 w-14 h-14 md:mb-4 md:w-16 md:h-16 object-contain">
                        <h3 class="text-lg md:text-xl font-semibold text-gray-900 mb-1 md:mb-2">Rekomendasi Musik</h3>
                        <p class="text-sm text-gray-600">Temukan daftar putar musik yang sesuai dengan moodmu untuk menenangkan jiwa.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Edukasi Kesehatan Mental Section --}}
        <section class="bg-white py-10 md:py-16">
            <div class="container mx-auto max-w-6xl px-4">
                <h2 class="text-3xl md:text-4xl font-bold text-center text-black mb-8 md:mb-12">Edukasi Kesehatan Mental</h2>

                <div class="space-y-10 md:space-y-20">

                    {{-- Section 1: Apa itu Kesehatan Mental? --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-6 md:gap-8">
                        <div class="order-2 md:order-1 text-center md:text-left">
                            <h3 class="text-xl md:text-2xl font-semibold text-gray-900 mb-2 md:mb-3">Apa itu Kesehatan Mental?</h3>
                            <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                                Kesehatan mental adalah kondisi kesejahteraan emosi dan pikiran. Sama pentingnya seperti kesehatan fisik, kesehatan mental memengaruhi cara kita berpikir, merasa, dan bertindak.
                            </p>
                        </div>
                        <div class="order-1 md:order-2 mt-4 md:mt-6 flex justify-center">
                            <iframe width="320" height="180" src="https://www.youtube.com/embed/oxx564hMBUI?si=WJyjrTX4dGPjifzl"
                                title="Edukasi Kesehatan Mental" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen class="rounded-lg shadow-md w-full max-w-sm md:max-w-none md:w-[420px]">
                            </iframe>
                        </div>
                    </div>

                    {{-- Section 2: Kenapa Kita Harus Mengenali Emosi? --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-6 md:gap-8">
                        <div class="order-2 md:order-1 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="bg-gray-100 rounded-lg p-5 shadow hover:shadow-lg transition cursor-pointer">
                                <h4 class="text-lg md:text-xl font-semibold text-[#252525] mb-1 md:mb-2">😠 Marah</h4>
                                <p class="text-xs md:text-sm text-gray-700">Bisa muncul karena stres atau tekanan.</p>
                            </div>
                            <div class="bg-gray-100 rounded-lg p-5 shadow hover:shadow-lg transition cursor-pointer">
                                <h4 class="text-lg md:text-xl font-semibold text-[#252525] mb-1 md:mb-2">😢 Sedih</h4>
                                <p class="text-xs md:text-sm text-gray-700">Mungkin karena kehilangan sesuatu yang berharga.</p>
                            </div>
                            <div class="bg-gray-100 rounded-lg p-5 shadow hover:shadow-lg transition cursor-pointer">
                                <h4 class="text-lg md:text-xl font-semibold text-[#252525] mb-1 md:mb-2">😊 Senang</h4>
                                <p class="text-xs md:text-sm text-gray-700">Datang dari hal-halsederhana yang membuat hati bahagia.</p>
                            </div>
                            <div class="bg-gray-100 rounded-lg p-5 shadow hover:shadow-lg transition cursor-pointer">
                                <h4 class="text-lg md:text-xl font-semibold text-[#252525] mb-1 md:mb-2">😨 Takut</h4>
                                <p class="text-xs md:text-sm text-gray-700">Biasanya muncul saat menghadapi hal yang tidak pasti.</p>
                            </div>
                        </div>

                        <div class="order-1 md:order-2 text-center md:text-left">
                            <h3 class="text-xl md:text-2xl font-semibold text-[#252525] mb-2 md:mb-3">Kenapa Kita Harus Mengenali Emosi?</h3>
                            <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                                Mengenali emosi bukan berarti lemah — justru ini adalah kekuatan. Dengan mengenali apa yang kita rasakan, kita bisa lebih sadar akan diri sendiri dan mengambil keputusan yang lebih sehat.
                            </p>
                        </div>
                    </div>

                    {{-- Section 3: Musik sebagai Terapi Emosi --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-6 md:gap-8">
                        <div class="order-2 md:order-1 text-center md:text-left">
                            <h3 class="text-xl md:text-2xl font-semibold text-gray-900 mb-2 md:mb-3">Musik sebagai Terapi Emosi</h3>
                            <p class="text-sm md:text-base text-gray-600 leading-relaxed mb-4">
                                Musik dapat menjadi teman yang memahami. Saat kita cemas, sedih, atau lelah, musik bisa membantu menenangkan pikiran dan memperbaiki suasana hati.
                            </p>
                        </div>
                        <div class="order-1 md:order-2 flex justify-center">
                            <iframe width="320" height="180" src="https://www.youtube.com/embed/UjhgHEDG0NU?si=P_RkwFs-oqmcEj3V"
                                title="Music Therapy Video" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen class="rounded-lg shadow-md w-full max-w-sm md:max-w-none md:w-[420px]">
                            </iframe>
                        </div>
                    </div>

                    {{-- Final Call to Action in Education Section --}}
                    <div class="text-center max-w-full px-4 sm:max-w-2xl mx-auto">
                        <h3 class="text-2xl md:text-3xl font-bold text-black mb-4 md:mb-6">Yuk Mulai Perjalanan Emosimu</h3>
                        <p class="text-base md:text-lg text-gray-600 mb-6 md:mb-8 leading-relaxed">
                            Sudah saatnya kamu mengenali emosimu. Tulis jurnal harian, temukan rekomendasi musik, dan rawat kesehatan mentalmu mulai sekarang.
                        </p>
                        <a href="{{ route('register') }}" class="inline-block bg-black text-white px-6 py-2 rounded-full font-semibold hover:bg-gray-800 transition text-sm md:px-8 md:py-3 md:text-base">
                            🌿 Mulai Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Artikel Section --}}
        <section id="artikel" class="py-10 md:py-16 bg-white">
            <div class="container mx-auto px-4 max-w-6xl">
                <h2 class="text-3xl md:text-3xl font-bold text-center text-black mb-8 md:mb-10">Artikel Seputar Kesehatan Mental</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8">
                    @foreach ($articles as $article)
                        <a href="{{ route('artikel.show', $article->id) }}" class="bg-gray-50 rounded-xl shadow-md hover:shadow-lg transition p-5 md:p-6 block">
                            <h3 class="font-semibold text-lg mb-1 text-black">
                                {{ $article->title }}
                            </h3>
                            <p class="text-sm text-gray-600">{{ $article->excerpt }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Global Call to Action Section --}}
        <section class="py-16 md:py-20 bg-white text-center text-black">
            <div class="container mx-auto px-4 max-w-full sm:max-w-4xl">
                <h2 class="text-2xl md:text-3xl font-bold mb-3 md:mb-4">Mulai Perjalananmu Menjaga Kesehatan Mental Hari Ini</h2>
                <p class="mb-5 md:mb-6 text-base md:text-lg">Gabung bersama pengguna lain yang telah merasa lebih baik bersama Vibely 🌱</p>
                <a href="{{ route('register') }}" class="bg-black text-white font-semibold px-6 py-2 rounded-full hover:bg-gray-800 transition text-sm md:px-6 md:py-3 md:text-base">Daftar Sekarang</a>
            </div>
        </section>

        {{-- Footer --}}
        <footer class="bg-white py-4 md:py-6 text-center text-xs md:text-sm text-gray-500">
            <p>© {{ date('Y') }} Vibely – Karena perasaanmu penting 🌻</p>
        </footer>

        {{-- JavaScript for slider (ensure elements exist before accessing) --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const slider = document.getElementById('emotionSlider');
                const prevBtn = document.getElementById('prevBtn');
                const nextBtn = document.getElementById('nextBtn');
                if (slider && prevBtn && nextBtn) { // Added checks for elements to exist
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
                }
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const slider = document.getElementById('emotionSlider');
                if (slider) { // Added check for element to exist
                    let currentIndex = 0;
                    const slidesCount = slider.children.length;

                    slider.addEventListener('click', () => {
                        currentIndex = (currentIndex + 1) % slidesCount;
                        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
                    });
                }
            });
        </script>

    </body>
</html>