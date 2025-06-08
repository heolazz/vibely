@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 bg-white px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto bg-white p-6 sm:p-10 rounded-3xl border border-gray-200 shadow-md text-center transform transition-all duration-300 hover:scale-102 hover:shadow-lg relative overflow-hidden flex flex-col lg:flex-row items-center lg:justify-center space-y-8 lg:space-y-0 lg:space-x-12">
        {{-- Dekorasi Bintik-bintik (Dot Pattern) - Tetap bisa dihapus jika tidak diinginkan --}}
        <div class="absolute inset-0 z-0 opacity-10" style="background-image: radial-gradient(#a0a0a0 1px, transparent 1px); background-size: 20px 20px;"></div>

        {{-- GIF Ilustrasi (Sisi Kiri, kini lebih ke tengah) --}}
        <div class="relative z-10 flex-shrink-0">
            <img src="{{ asset('images/gif/cat-greeting.gif') }}" alt="Cat Greeting"
                 class="w-48 h-48 sm:w-56 sm:h-56 rounded-full object-cover mb-4 ">
        </div>

        {{-- Konten Teks (Sisi Kanan) --}}
        <div class="relative z-10 flex flex-col items-center lg:items-start text-center lg:text-left space-y-6 flex-grow">
            {{-- Icon Sukses --}}
            <div class="bg-green-100 text-green-600 rounded-full p-5 sm:p-6 shadow-md border border-green-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 sm:h-12 sm:w-12" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                </svg>
            </div>

            {{-- Judul --}}
            <h2 class="text-3xl sm:text-5xl font-extrabold text-gray-800 tracking-tight leading-tight">
                Kamu sudah mengisi Kuesioner minggu ini!
            </h2>

            {{-- Pesan --}}
            <p class="text-gray-600 text-lg sm:text-xl leading-relaxed mt-3">
                Terima kasih banyak telah mengisi kuesioner minggu ini. <br class="hidden sm:inline">
                Kami menantikan refleksi suasana hati Anda minggu depan!
            </p>

            {{-- Tombol Kembali --}}
            <a href="{{ route('dashboard') }}"
               class="mt-6 inline-flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white font-bold px-8 py-3 sm:px-10 sm:py-4 rounded-full transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-blue-300 focus:ring-offset-2 text-lg">
                <i class="fas fa-home mr-3"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>


@endsection
