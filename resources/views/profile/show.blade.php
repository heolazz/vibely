@extends('layouts.main')

@section('title', 'Profil Saya')

@section('header')
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-800">Profil Saya</h2>
        <a href="{{ route('dashboard') }}"
           class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
            Kembali ke Dashboard
        </a>
    </div>
    
@endsection

@section('content')
    <div class="space-y-6">
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            <div class="bg-white shadow rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900">Informasi Profil</h3>
                <p class="text-sm text-gray-500 mb-4">Perbarui nama dan alamat email Anda.</p>
                @livewire('profile.update-profile-information-form')
            </div>
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="bg-white shadow rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900">Ubah Password</h3>
                <p class="text-sm text-gray-500 mb-4">Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.</p>
                @livewire('profile.update-password-form')
            </div>
        @endif

        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <div class="bg-white shadow rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900">Autentikasi Dua Faktor</h3>
                <p class="text-sm text-gray-500 mb-4">Tambahkan keamanan ekstra dengan autentikasi dua faktor.</p>
                @livewire('profile.two-factor-authentication-form')
            </div>
        @endif

        <div class="bg-white shadow rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900">Sesi Peramban Lain</h3>
            <p class="text-sm text-gray-500 mb-4">Keluar dari semua sesi login di perangkat lain.</p>
            @livewire('profile.logout-other-browser-sessions-form')
        </div>

        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <div class="bg-white shadow rounded-xl p-6">
                <h3 class="text-lg font-semibold text-red-600">Hapus Akun</h3>
                <p class="text-sm text-gray-500 mb-4">Menghapus akun ini bersifat permanen dan tidak bisa dikembalikan.</p>
                @livewire('profile.delete-user-form')
            </div>
        @endif
    </div>
@endsection
