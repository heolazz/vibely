<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 p-4 font-sans antialiased">
        <div class="flex w-full max-w-5xl bg-white rounded-2xl shadow-2xl overflow-hidden transition-transform duration-500 ease-in-out hover:scale-[1.005]">
            {{-- Hero Kiri --}}
            <div class="hidden md:block w-1/2 p-10 text-white relative bg-gray-800 rounded-l-2xl">
                <div class="relative z-10 flex flex-col justify-between h-full">
                    <div class="text-xs tracking-widest uppercase mb-4 opacity-80">
                        <span class="inline-block px-3 py-1 rounded-full text-gray-100 font-semibold">
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
                                <img src="{{ asset("icons/{$feature['src']}") }}" alt="{{ $feature['label'] }}" class="w-5 h-5 mr-2">
                                {{ $feature['label'] }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Form Register --}}
            <div class="w-full md:w-1/2 p-8 lg:p-14 bg-white flex flex-col justify-center rounded-2xl md:rounded-l-none">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-extrabold text-gray-700 mb-2 tracking-tight">Buat Akun Vibely</h2>
                    <p class="text-md text-gray-600 mt-2">Daftar untuk memulai perjalanan kesehatan mentalmu</p>
                </div>

                <x-validation-errors class="mb-5" />

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <x-label for="name" value="Nama Lengkap" class="text-gray-800 font-semibold mb-1" />
                        <x-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                                 placeholder="Masukkan nama lengkap Anda"
                                 class="w-full p-3.5 border-gray-300 rounded-lg shadow-sm focus:border-gray-500 focus:ring-gray-500 transition duration-200" />
                    </div>

                    {{-- Email --}}
                    <div>
                        <x-label for="email" value="Email" class="text-gray-800 font-semibold mb-1" />
                        <x-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                                 placeholder="Masukkan email Anda"
                                 class="w-full p-3.5 border-gray-300 rounded-lg shadow-sm focus:border-gray-500 focus:ring-gray-500 transition duration-200" />
                    </div>

                    {{-- Password and Confirm Password side-by-side using grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Password --}}
                        <div> {{-- Removed 'relative' from here --}}
                            <x-label for="password" value="Kata Sandi" class="text-gray-800 font-semibold mb-1" />
                            <div class="relative flex items-center"> {{-- Added 'relative flex items-center' --}}
                                <x-input id="password" type="password" name="password" required autocomplete="new-password"
                                         placeholder="Masukkan kata sandi Anda"
                                         class="w-full p-3.5 border-gray-300 rounded-lg shadow-sm focus:border-gray-500 focus:ring-gray-500 transition duration-200 pr-10" /> {{-- Added pr-10 --}}
                                <span id="togglePassword" class="absolute right-3 text-gray-400 hover:text-gray-600 cursor-pointer transition-colors duration-200">
                                    <img src="{{ asset('icons/visible.png') }}" alt="Toggle Password Visibility" class="w-5 h-5" id="eye-icon-img">
                                </span>
                            </div>
                        </div>

                        {{-- Confirm Password --}}
                        <div> {{-- Removed 'relative' from here --}}
                            <x-label for="password_confirmation" value="Konfirmasi Kata Sandi" class="text-gray-800 font-semibold mb-1" />
                            <div class="relative flex items-center"> {{-- Added 'relative flex items-center' --}}
                                <x-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                         placeholder="Konfirmasi kata sandi Anda"
                                         class="w-full p-3.5 border-gray-300 rounded-lg shadow-sm focus:border-gray-500 focus:ring-gray-500 transition duration-200 pr-10" /> {{-- Added pr-10 --}}
                                <span id="togglePasswordConfirmation" class="absolute right-3 text-gray-400 hover:text-gray-600 cursor-pointer transition-colors duration-200">
                                    <img src="{{ asset('icons/visible.png') }}" alt="Toggle Password Confirmation Visibility" class="w-5 h-5" id="eye-icon-confirm-img">
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Terms and Privacy Policy (if applicable) --}}
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required />

                                    <div class="ms-2">
                                        {!! __("Saya setuju dengan :terms_of_service dan :privacy_policy", [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Ketentuan Layanan').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Kebijakan Privasi').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif

                    {{-- Register Button --}}
                    <div class="pt-2">
                        <x-button class="w-full justify-center bg-gray-800 hover:bg-gray-900 active:bg-gray-900 text-white font-bold py-3.5 rounded-lg shadow-lg hover:shadow-xl transition-transform duration-200 hover:-translate-y-0.5 text-lg">
                            Daftar
                        </x-button>
                    </div>
                </form>

                {{-- Link Login --}}
                <div class="text-center mt-8 text-md text-gray-700">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-gray-700 hover:underline font-bold transition-colors duration-200">
                        Masuk
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Toggle Password Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIconImg = document.getElementById('eye-icon-img');

            const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
            const passwordConfirmationInput = document.getElementById('password_confirmation');
            const eyeIconConfirmImg = document.getElementById('eye-icon-confirm-img');

            togglePassword.addEventListener('click', () => {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                eyeIconImg.src = isPassword
                    ? "{{ asset('icons/hide.png') }}"
                    : "{{ asset('icons/visible.png') }}";
            });

            togglePasswordConfirmation.addEventListener('click', () => {
                const isPasswordConfirm = passwordConfirmationInput.type === 'password';
                passwordConfirmationInput.type = isPasswordConfirm ? 'text' : 'password';
                eyeIconConfirmImg.src = isPasswordConfirm
                    ? "{{ asset('icons/hide.png') }}"
                    : "{{ asset('icons/visible.png') }}";
            });
        });
    </script>
</x-guest-layout>