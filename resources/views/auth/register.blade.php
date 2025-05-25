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

            <div>
                <x-label for="password" value="Kata Sandi" class="text-gray-700 font-medium" />
                <x-input id="password" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                         type="password" name="password" required autocomplete="new-password" />
            </div>

            <div>
                <x-label for="password_confirmation" value="Konfirmasi Kata Sandi" class="text-gray-700 font-medium" />
                <x-input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                         type="password" name="password_confirmation" required autocomplete="new-password" />
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
