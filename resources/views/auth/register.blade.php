<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="text-center mb-1">
                <h2 class="text-2xl font-bold text-indigo-600">Bergabung dengan Vibely</h2>
                <p class="text-sm text-gray-500 mt-1">Mulai perjalanan kesejahteraanmu dengan mendaftar di Vibely 🌱</p>
            </div>
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div>
                <x-label for="name" value="Nama" class="text-gray-700 font-medium" />
                <x-input id="name" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                         type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div>
                <x-label for="email" value="Email" class="text-gray-700 font-medium" />
                <x-input id="email" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                         type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            {{-- Password dengan toggle mata --}}
            <div x-data="{ show: false }" class="relative">
                <x-label for="password" value="Kata Sandi" class="text-gray-700 font-medium" />
                <input id="password" name="password" :type="show ? 'text' : 'password'" required autocomplete="new-password"
                       class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                    <svg @click="show = !show" :class="{'hidden': show, 'block': !show}" class="h-5 w-5 text-gray-500 cursor-pointer" fill="none"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg @click="show = !show" :class="{'block': show, 'hidden': !show}" class="h-5 w-5 text-gray-500 cursor-pointer" fill="none"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.05 10.05 0 012.114-3.592m1.418-1.418A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.963 9.963 0 01-4.293 5.258M3 3l18 18" />
                    </svg>
                </div>
            </div>

            {{-- Konfirmasi Password dengan toggle mata --}}
            <div x-data="{ show: false }" class="relative">
                <x-label for="password_confirmation" value="Konfirmasi Kata Sandi" class="text-gray-700 font-medium" />
                <input id="password_confirmation" name="password_confirmation" :type="show ? 'text' : 'password'" required autocomplete="new-password"
                       class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                    <svg @click="show = !show" :class="{'hidden': show, 'block': !show}" class="h-5 w-5 text-gray-500 cursor-pointer" fill="none"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg @click="show = !show" :class="{'block': show, 'hidden': !show}" class="h-5 w-5 text-gray-500 cursor-pointer" fill="none"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.05 10.05 0 012.114-3.592m1.418-1.418A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.963 9.963 0 01-4.293 5.258M3 3l18 18" />
                    </svg>
                </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />
                            <div class="ms-2">
                                {!! __('Saya setuju dengan :terms_of_service dan :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Syarat dan Ketentuan').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Kebijakan Privasi').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <p class="text-sm opacity-70 mr-1">Sudah punya akun?</p> 
                <a class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" 
                   href="{{ route('login') }}">
                    Masuk
                </a>

                <x-button class="ms-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded-lg shadow-sm transition duration-200">
                    Daftar
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
