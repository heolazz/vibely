<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-indigo-600">Selamat Datang di Vibely</h2>
                <p class="text-sm text-gray-500 mt-1">Masuk untuk mulai mengelola kesehatan mentalmu 🌱</p>
            </div>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 text-sm text-green-700 bg-green-50 border border-green-200 rounded-md p-3">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <x-label for="email" value="Email" class="text-gray-700 font-medium" />
                <x-input id="email" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                         type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div>
                <x-label for="password" value="Kata Sandi" class="text-gray-700 font-medium" />
                <x-input id="password" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                         type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-indigo-600 hover:text-indigo-800 transition ease-in-out duration-150" 
                       href="{{ route('password.request') }}">
                        Lupa kata sandi?
                    </a>
                @endif
            </div>

            <div>
                <x-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded-lg shadow-sm transition duration-200">
                    Masuk
                </x-button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="text-center mt-6 text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline font-medium">
                    Daftar sekarang
                </a>
            </div>
        @endif
    </x-authentication-card>
</x-guest-layout>
