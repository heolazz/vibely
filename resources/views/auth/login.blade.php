<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-blue-50 p-4 font-sans antialiased">
        <div class="flex w-full max-w-5xl bg-white rounded-2xl shadow-2xl overflow-hidden transition-transform duration-500 ease-in-out hover:scale-[1.005]">
            {{-- Hero Kiri --}}
            {{-- Menggunakan kelas gradient Tailwind yang tersedia --}}
            <div class="hidden md:block w-1/2 p-10 text-white relative bg-gradient-to-br from-blue-600 via-sky-500 to-blue-500 rounded-l-2xl">
                <div class="absolute inset-0 bg-black bg-opacity-30 z-0 rounded-l-2xl"></div> {{-- Menggunakan bg-opacity --}}
                <div class="relative z-10 flex flex-col justify-between h-full">
                    <div class="text-xs tracking-widest uppercase mb-4 opacity-80">
                        <span class="inline-block px-3 py-1 rounded-full bg-white bg-opacity-20 backdrop-blur-sm text-white font-semibold">
                            Vibely Insight
                        </span>
                    </div>
                    <div class="mb-auto mt-8">
                        <h1 class="text-5xl font-extrabold leading-tight drop-shadow-lg">
                            Kelola Emosi, Temukan Ketenangan Jiwa
                        </h1>
                        <p class="mt-6 text-lg leading-relaxed opacity-90 font-light">
                            Vibely hadir untuk mendukung perjalanan kesehatan mentalmu. Catat jurnal emosi harianmu dan jelajahi rekomendasi musik yang menenangkan hatimu.
                        </p>
                    </div>
                    <div class="flex space-x-6 opacity-90 mt-6">
                        @php
                            $features = [
                                ['src' => 'icon-journal.png', 'label' => 'Jurnal Emosi'],
                                ['src' => 'icon-music.png', 'label' => 'Rekomendasi Musik'],
                                ['src' => 'icon-education.png', 'label' => 'Edukasi Kesehatan Mental']
                            ];
                        @endphp

                        @foreach($features as $feature)
                            <span class="flex items-center text-sm">
                                <img src="{{ asset("icons/{$feature['src']}") }}" alt="{{ $feature['label'] }}" class="w-5 h-5 mr-2 filter invert brightness-0 saturate-200 hue-rotate-180">
                                {{ $feature['label'] }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Form Login --}}
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

                    {{-- Email --}}
                    <div>
                        <x-label for="email" value="Email" class="text-gray-800 font-semibold mb-1" />
                        {{-- Pastikan kelas yang Anda inginkan diterapkan dengan benar --}}
                        <x-input id="email" type="email" name="email" :value="old('email')" required autofocus
                                 placeholder="Masukkan email Anda"
                                 class="w-full p-3.5 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-200" />
                    </div>

                    {{-- Password --}}
                    <div class="relative">
                        <x-label for="password" value="Kata Sandi" class="text-gray-800 font-semibold mb-1" />
                        {{-- Pastikan kelas yang Anda inginkan diterapkan dengan benar --}}
                        <x-input id="password" type="password" name="password" required
                                 placeholder="Masukkan kata sandi Anda"
                                 class="w-full p-3.5 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-200" />
                        <span id="togglePassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 cursor-pointer transition-colors duration-200">
                            <img src="{{ asset('icons/visible.png') }}" alt="Toggle Password Visibility" class="w-5 h-5" id="eye-icon-img">
                        </span>
                    </div>

                    {{-- Remember Me + Forgot --}}
                    <div class="flex items-center justify-between mt-5">
                        <label for="remember_me" class="flex items-center text-gray-700">
                            <x-checkbox id="remember_me" name="remember" class="h-4 w-4 text-blue-600 rounded focus:ring-blue-500" />
                            <span class="ml-2 text-sm">Ingat saya</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-bold text-gray-600 hover:text-gray-800 transition">
                                Lupa kata sandi?
                            </a>
                        @endif
                    </div>

                    {{-- Tombol Login --}}
                    <div class="pt-2">
                        {{-- Menggunakan kelas Tailwind untuk tombol yang lebih sederhana dan konsisten --}}
                        <x-button class="w-full justify-center bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold py-3.5 rounded-lg shadow-lg hover:shadow-xl transition-transform duration-200 hover:-translate-y-0.5 text-lg">
                            Masuk
                        </x-button>
                    </div>
                </form>

                {{-- Link Daftar --}}
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

    {{-- Toggle Password Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIconImg = document.getElementById('eye-icon-img');

            togglePassword.addEventListener('click', () => {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                eyeIconImg.src = isPassword
                    ? "{{ asset('icons/hide.png') }}"
                    : "{{ asset('icons/visible.png') }}";
            });
        });
    </script>
</x-guest-layout>