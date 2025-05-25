@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-20 bg-white p-10 rounded-xl shadow-md border border-gray-200 text-center">
    <div class="flex flex-col items-center space-y-4">
        {{-- Icon Sukses --}}
        <div class="bg-green-100 text-green-600 rounded-full p-4 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
            </svg>
        </div>

        {{-- Judul --}}
        <h2 class="text-2xl font-bold text-gray-800">Kuesioner Sudah Diisi 🎉</h2>

        {{-- Pesan --}}
        <p class="text-gray-600 text-base">
            Terima kasih telah mengisi kuesioner minggu ini. <br>
            Silakan kembali minggu depan untuk melanjutkan refleksi suasana hati Anda.
        </p>

        {{-- Tombol Kembali --}}
        <a href="{{ route('dashboard') }}"
           class="mt-6 inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md transition shadow">
            Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection
