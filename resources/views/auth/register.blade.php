<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-100 to-indigo-100 p-4 font-sans antialiased">
        <div class="flex w-full max-w-5xl bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-500 ease-in-out hover:scale-[1.005]">
            <div class="hidden md:block w-1/2 p-10 text-white relative flex flex-col justify-between"
                 style="background: linear-gradient(135deg, #007BFF 0%, #00BFFF 50%, #4682B4 100%); /* Blue gradient */
                        background-size: cover; background-position: center;
                        border-radius: 1rem 0 0 1rem;">
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
                    <h2 class="text-3xl font-extrabold text-gray-700 mb-2 tracking-tight">Bergabung dengan Vibely</h2>
                    <p class="text-md text-gray-600 mt-2">Mulai perjalanan kesejahteraanmu dengan mendaftar di Vibely</p>
                </div>

                <x-validation-errors class="mb-5" />

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-label for="name" value="Nama" class="text-gray-800 font-semibold mb-1" />
                        <x-input id="name" class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm p-3.5 transition duration-200 ease-in-out"
                                 type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                                 placeholder="Masukkan nama Anda" />
                    </div>

                    <div>
                        <x-label for="email" value="Email" class="text-gray-800 font-semibold mb-1" />
                        <x-input id="email" class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm p-3.5 transition duration-200 ease-in-out"
                                 type="email" name="email" :value="old('email')" required autocomplete="username"
                                 placeholder="Masukkan alamat email Anda" />
                    </div>

                    {{-- Password dan Konfirmasi Password berdampingan --}}
                    <div class="flex flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-4">
                        {{-- Password --}}
                        <div class="relative w-full md:w-1/2">
                            <x-label for="password" value="Kata Sandi" class="text-gray-800 font-semibold mb-1" />
                            <div x-data="{ show: false }" class="relative"> {{-- Alpine data moved here --}}
                                <x-input id="password" name="password" x-bind:type="show ? 'text' : 'password'" required autocomplete="new-password"
                                         class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm p-3.5 pr-10 transition duration-200 ease-in-out"
                                         placeholder="Buat kata sandi Anda" />
                                <span @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                                    <img x-bind:src="show ? '{{ asset('icons/hide.png') }}' : '{{ asset('icons/visible.png') }}'" 
                                         alt="Toggle Password Visibility" class="w-5 h-5 text-gray-400 hover:text-gray-600">
                                </span>
                            </div>
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div class="relative w-full md:w-1/2">
                            <x-label for="password_confirmation" value="Konfirmasi Kata Sandi" class="text-gray-800 font-semibold mb-1" />
                            <div x-data="{ show: false }" class="relative"> {{-- Alpine data moved here --}}
                                <x-input id="password_confirmation" name="password_confirmation" x-bind:type="show ? 'text' : 'password'" required autocomplete="new-password"
                                         class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm p-3.5 pr-10 transition duration-200 ease-in-out"
                                         placeholder="Konfirmasi kata sandi Anda" />
                                <span @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                                    <img x-bind:src="show ? '{{ asset('icons/hide.png') }}' : '{{ asset('icons/visible.png') }}'" 
                                         alt="Toggle Password Visibility" class="w-5 h-5 text-gray-400 hover:text-gray-600">
                                </span>
                            </div>
                        </div>
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-6">
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required class="form-checkbox h-4 w-4 text-blue-600 rounded focus:ring-blue-500 transition duration-150 ease-in-out" />
                                    <div class="ms-2 text-gray-700">
                                        {!! __('Saya setuju dengan :terms_of_service dan :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 font-bold">'.__('Syarat dan Ketentuan').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 font-bold">'.__('Kebijakan Privasi').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif

                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center">
                            <p class="text-sm text-gray-700 mr-1">Sudah punya akun?</p>
                            <a class="text-sm font-bold text-gray-600 hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                               href="{{ route('login') }}">
                                Masuk
                            </a>
                        </div>

                        <x-button class="ms-4 bg-gray-600 hover:bg-gray-700 active:bg-gray-800 text-white font-bold py-3.5 rounded-lg shadow-lg hover:shadow-xl transition transform duration-200 ease-in-out hover:-translate-y-0.5 text-lg">
                            Daftar
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>