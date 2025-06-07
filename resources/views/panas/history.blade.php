@extends('layouts.app')

@section('content')
<div class="bg-white py-12 min-h-screen"> {{-- Latar belakang putih keseluruhan --}}
    <div class="max-w-4xl mx-auto px-6 sm:px-8 lg:px-10">
        {{-- Judul Halaman --}}
        <h2 class="text-3xl font-bold text-gray-900 mb-10 text-center">Riwayat Hasil <span class="text-blue-600">Kuesioner Anda</span></h2>

        @if ($history->isEmpty())
            {{-- Pesan Riwayat Kosong --}}
            <div class="bg-gray-50 border border-gray-200 text-gray-700 p-6 rounded-lg shadow-sm mb-8 text-center">
                <p class="text-lg font-semibold mb-2">Belum ada hasil kuesioner sebelumnya.</p>
                <p class="text-md">Silakan <a href="{{ route('panas.show') }}" class="font-bold text-blue-600 hover:underline">isi kuesioner</a> terlebih dahulu untuk melihat riwayat Anda.</p>
            </div>
        @else
            {{-- Grid Hasil Kuesioner --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($history as $result)
                    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition duration-300 border border-gray-100">
                        <div class="p-6">
                            {{-- Header Kartu --}}
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-4 pb-3 border-b border-gray-100">
                                <h3 class="text-xl font-semibold text-gray-800 flex items-center mb-2 sm:mb-0">
                                    {{-- Icon Statistik (Heroicons) --}}
                                    <!-- <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0-10V5a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2a2 2 0 002-2z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15h2m-2-4h2m-2-4h2m-2-4h2m-2 4h.01M17 9h.01M19 13h.01M21 7h.01"></path>
                                    </svg> -->
                                    Hasil #<span class="text-gray-500 font-normal">{{ $loop->iteration }}</span>
                                </h3>
                                {{-- Tanggal dan Waktu --}}
                                <span class="text-sm text-gray-500 font-medium">{{ $result->created_at->isoFormat('DD MMMM YYYY, HH:mm') }} WIB</span>
                            </div>

                            {{-- Detail Skor & Tipe Mood --}}
                            <ul class="mt-4 space-y-3 text-gray-800 text-base">
                                {{-- Skor Positive Affect (PA) --}}
                                <li class="flex items-center">
                                    <span class="font-medium text-gray-700 flex-shrink-0 mr-2 w-24">PA Score:</span>
                                    <span class="font-semibold text-blue-600 text-lg">{{ $result->pa_score }}</span>
                                    {{-- Progress Bar PA --}}
                                    <div class="ml-4 flex-grow bg-blue-50 rounded-full h-2">
                                        <div class="bg-blue-500 h-2 rounded-full" style="width: {{ ($result->pa_score / 50) * 100 }}%;"></div> {{-- Asumsi max score 50 --}}
                                    </div>
                                </li>
                                {{-- Skor Negative Affect (NA) --}}
                                <li class="flex items-center">
                                    <span class="font-medium text-gray-700 flex-shrink-0 mr-2 w-24">NA Score:</span>
                                    <span class="font-semibold text-gray-600 text-lg">{{ $result->na_score }}</span> {{-- NA score sekarang abu-abu --}}
                                    {{-- Progress Bar NA --}}
                                    <div class="ml-4 flex-grow bg-gray-100 rounded-full h-2">
                                        <div class="bg-gray-400 h-2 rounded-full" style="width: {{ ($result->na_score / 50) * 100 }}%;"></div> {{-- Asumsi max score 50 --}}
                                    </div>
                                </li>
                                {{-- Tipe Mood --}}
                                <li class="flex items-center">
                                    <span class="font-medium text-gray-700 flex-shrink-0 mr-2 w-24">Mood Type:</span>
                                    <span class="font-bold text-lg
                                        @if($result->mood_type == 'Positif') text-blue-600
                                        @elseif($result->mood_type == 'Negatif') text-gray-600
                                        @elseif($result->mood_type == 'Campuran') text-purple-600 {{-- Untuk Campuran, bisa gunakan ungu --}}
                                        @else text-gray-500
                                        @endif
                                    ">
                                        {{ $result->mood_type }}
                                    </span>
                                </li>
                            </ul>

                            {{-- Link Lihat Detail --}}
                            <div class="mt-6 text-right">
                               <a href="{{ route('panas.result_detail', $result->id) }}" class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-700 transition">
                                    Lihat Detail
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Paginasi --}}
            <div class="mt-10 text-center">
                {{ $history->links() }}
            </div>
        @endif

        {{-- Tombol Aksi Bawah Halaman --}}
        <div class="mt-12 text-center">
            <a href="{{ route('panas.show') }}" class="inline-flex items-center bg-blue-600 text-white px-6 py-2 rounded-full text-base font-semibold hover:bg-blue-700 transition duration-300 shadow-md">
                <!-- <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8m-9 1a9 9 0 110-18 9 9 0 010 18z"></path></svg> -->
                Isi Kuesioner Baru
            </a>
            <p class="mt-4 text-sm text-gray-500">
                Atau kembali ke dashboard: <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline font-medium">Dashboard</a>
            </p>
        </div>
    </div>
</div>
@endsection