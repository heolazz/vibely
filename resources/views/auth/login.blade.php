<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-100 to-indigo-100 p-4 font-sans antialiased">
        <div class="flex w-full max-w-5xl bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-500 ease-in-out hover:scale-[1.005]">
            <div class="hidden md:block w-1/2 p-10 text-white relative flex flex-col justify-between"
                 style="background: linear-gradient(135deg, #007BFF 0%, #00BFFF 50%, #4682B4 100%); /* Blue gradient */
                        background-size: cover; background-position: center;
                        border-radius: 1rem 0 0 1rem; /* Match parent container border-radius */">
                <div class="absolute inset-0 bg-black opacity-30 z-0 rounded-4xl"></div>
                <div class="relative z-10 flex flex-col justify-between h-full">
                    <div class="text-xs tracking-widest uppercase mb-4 opacity-80">
                        <span class="inline-block px-3 py-1 rounded-full bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm text-white font-semibold">Vibely Insight</span>
                    </div>
                    <div class="mb-auto mt-8">
                        <h1 class="text-5xl font-extrabold leading-tight drop-shadow-lg">
                            Kelola Emosi, Temukan Ketenangan Jiwa
                        </h1>
                        <p class="mt-6 text-lg leading-relaxed opacity-90 font-light">
                            Vibely hadir untuk mendukung perjalanan kesehatan mentalmu. Catat jurnal emosi harianmu dan jelajahi rekomendasi musik yang menenangkan hatimu.
                        </p>
                    </div>
                    <div class="flex space-x-6 opacity-90">
                        <span class="flex items-center text-sm">
                            <img src="{{ asset('icons/icon-journal.png') }}" alt="Jurnal Emosi Icon" class="w-5 h-5 mr-2 filter invert brightness-0 saturate-200 hue-rotate-180">
                            Jurnal Emosi
                        </span>
                        <span class="flex items-center text-sm">
                            <img src="{{ asset('icons/icon-music.png') }}" alt="Rekomendasi Musik Icon" class="w-5 h-5 mr-2 filter invert brightness-0 saturate-200 hue-rotate-180">
                            Rekomendasi Musik
                        </span>
                        <span class="flex items-center text-sm">
                            <img src="{{ asset('icons/icon-education.png') }}" alt="Edukasi Kesehatan Mental Icon" class="w-5 h-5 mr-2 filter invert brightness-0 saturate-200 hue-rotate-180">
                            Edukasi Kesehatan Mental
                        </span>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-1/2 p-8 lg:p-14 bg-white flex flex-col justify-center rounded-2xl md:rounded-l-none">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-extrabold text-gray-700 mb-2 tracking-tight">Selamat Datang di Vibely</h2>
                    <p class="text-md text-gray-600 mt-2">Masuk untuk mulai mengelola kesehatan mentalmu</p>
                </div>

                <x-validation-errors class="mb-5" />

                @if (session('status'))
                    <div class="mb-5 text-sm text-green-700 bg-green-50 border border-green-200 rounded-lg p-3 shadow-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-label for="email" value="Email" class="text-gray-800 font-semibold mb-1" />
                        <x-input id="email" class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm p-3.5 transition duration-200 ease-in-out"
                                 type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                                 placeholder="Masukkan email Anda" />
                    </div>

                    <div class="relative">
                        <x-label for="password" value="Kata Sandi" class="text-gray-800 font-semibold mb-1" />
                        <x-input id="password" class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm p-3.5 transition duration-200 ease-in-out"
                                 type="password" name="password" required autocomplete="current-password"
                                 placeholder="Masukkan kata sandi Anda" />
                        <span id="togglePassword" class="absolute right-3 top-1/2 mt-2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 cursor-pointer transition-colors duration-200">
                            {{-- Initial eye icon (open) --}}
                            <img src="{{ asset('icons/visible.png') }}" alt="Toggle Password Visibility" class="w-5 h-5" id="eye-icon-img">
                        </span>
                    </div>

                    <div class="flex items-center justify-between mt-5">
                        <label for="remember_me" class="flex items-center text-gray-700">
                            <x-checkbox id="remember_me" name="remember" class="form-checkbox h-4 w-4 text-blue-600 rounded focus:ring-blue-500 transition duration-150 ease-in-out" />
                            <span class="ml-2 text-sm">Ingat saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-600 hover:text-gray-800 transition ease-in-out duration-150 font-bold"
                               href="{{ route('password.request') }}">
                                Lupa kata sandi?
                            </a>
                        @endif
                    </div>

                    <div class="pt-2">
                        <x-button class="w-full justify-center bg-gray-600 hover:bg-gray-700 active:bg-gray-800 text-white font-bold py-3.5 rounded-lg shadow-lg hover:shadow-xl transition transform duration-200 ease-in-out hover:-translate-y-0.5 text-lg">
                            Masuk
                        </x-button>
                    </div>
                </form>

                @if (Route::has('register'))
                    <div class="text-center mt-8 text-md text-gray-700">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-gray-600 hover:underline font-bold transition-colors duration-200">
                            Daftar sekarang
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- JavaScript for password visibility toggle --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIconImg = document.getElementById('eye-icon-img'); // Changed to img element ID

            // Set initial icon src (open eye)
            eyeIconImg.src = "{{ asset('icons/visible.png') }}";

            togglePassword.addEventListener('click', function () {
                const currentType = passwordInput.getAttribute('type');

                if (currentType === 'password') {
                    // Password is currently hidden (eye is open), user wants to SHOW it
                    passwordInput.setAttribute('type', 'text');
                    eyeIconImg.src = "{{ asset('icons/hide.png') }}"; // Change to hide icon
                } else {
                    // Password is currently visible (eye is closed), user wants to HIDE it
                    passwordInput.setAttribute('type', 'password');
                    eyeIconImg.src = "{{ asset('icons/visible.png') }}"; // Change to visible icon
                }
            });
        });
    </script>
</x-guest-layout>