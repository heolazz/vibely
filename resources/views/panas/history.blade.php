@extends('layouts.app')

@section('content')
<div class="bg-white py-12 min-h-screen">
    <div class="max-w-4xl mx-auto px-6 sm:px-8 lg:px-10">
        <h2 class="text-3xl font-bold text-gray-900 mb-10 text-center">Riwayat Hasil <span class="text-blue-600">Kuesioner Anda</span></h2>

        @if ($history->isEmpty())
            <div class="bg-gray-50 border border-gray-200 text-gray-700 p-6 rounded-lg shadow-sm mb-8 text-center">
                <p class="text-lg font-semibold mb-2">Belum ada hasil kuesioner sebelumnya.</p>
                <p class="text-md">Silakan <a href="{{ route('panas.show') }}" class="font-bold text-blue-600 hover:underline">isi kuesioner</a> terlebih dahulu untuk melihat riwayat Anda.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($history as $result)
                    @php
                        // Access the moodText and moodTagColor directly from the $result object
                        // as they are set in the controller's history() method.
                        $moodText = $result->moodText;
                        $moodTagColor = $result->moodTagColor;

                        $moodImages = [
                            'Positif'           => 'happy-mood.gif',
                            'Negatif'           => 'negatif-mood2.gif',
                            'Netral'            => 'netral-mood.gif',
                            'Campuran'          => 'mix-mood.gif',
                            'Cenderung Positif' => 'happy-mood.gif',
                            'Cenderung Negatif' => 'negatif-mood2.gif',
                        ];
                        $moodImage = asset('images/stickers/' . ($moodImages[$moodText] ?? 'netral-sticker.png'));
                    @endphp

                    <a href="{{ route('panas.result_detail', $result->id) }}" class="block bg-white rounded-2xl shadow-sm hover:shadow-lg transition duration-300 border border-gray-100 overflow-hidden group">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-bold text-gray-900 flex items-center">
                                    Hasil Kuesioner #{{ $loop->iteration }}
                                </h3>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $moodTagColor }} whitespace-nowrap">
                                    {{ $moodText }}
                                </span>
                            </div>

                            <div class="flex justify-center items-center h-32 mb-4 bg-gray-50 rounded-lg border border-gray-200">
                                <img src="{{ $moodImage }}" alt="Sticker {{ $moodText }}" class="h-24 w-24 object-contain" />
                            </div>

                            <div class="text-sm text-gray-600 text-center mb-4">
                                <p class="font-medium">Diisi pada: <span class="font-semibold text-gray-800">{{ $result->created_at->isoFormat('DD MMMM YYYY') }}</span></p>
                                <p class="font-medium">Pukul: <span class="font-semibold text-gray-800">{{ $result->created_at->isoFormat('HH:mm') }} WIB</span></p>
                                <div class="flex justify-center mt-2 space-x-4">
                                    <span class="inline-flex items-center text-blue-600 font-semibold">PA: {{ $result->pa_score }}</span>
                                    <span class="inline-flex items-center text-gray-600 font-semibold">NA: {{ $result->na_score }}</span>
                                </div>
                            </div>

                            <div class="text-center mt-6">
                                <span class="inline-flex items-center px-5 py-2 rounded-full text-sm font-semibold bg-blue-500 text-white group-hover:bg-blue-600 transition duration-300 transform group-hover:scale-105 shadow-md">
                                    Lihat Detail
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-10 text-center">
                {{ $history->links() }}
            </div>
        @endif

        <div class="mt-12 text-center">
            <a href="{{ route('panas.show') }}" class="inline-flex items-center bg-blue-600 text-white px-6 py-2 rounded-full text-base font-semibold hover:bg-blue-700 transition duration-300 shadow-md">
                Isi Kuesioner Baru
            </a>
            <p class="mt-4 text-sm text-gray-500">
                Atau kembali ke dashboard: <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline font-medium">Dashboard</a>
            </p>
        </div>
    </div>
</div>
@endsection