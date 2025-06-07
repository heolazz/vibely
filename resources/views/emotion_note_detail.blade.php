@extends('layouts.app')

@section('content')
<div class="bg-cover bg-center min-h-screen py-12" style="background-image: url('{{ asset('images/bg-kuiz.jpg') }}');">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-center text-white mb-8 drop-shadow-lg">Detail Catatan Emosi Anda</h1>

        <div class="bg-white bg-opacity-90 backdrop-blur-md p-8 rounded-lg shadow-md mb-8">
            <div class="mb-6 border-b pb-4">
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Emosi: <span class="capitalize text-blue-600">{{ ucfirst($emotionNote->emotion) }}</span></h2>
                <p class="text-gray-600 text-sm mb-4">{{ $emotionNote->created_at->format('d M Y, H:i') }}</p>

                <h3 class="text-xl font-semibold text-gray-700 mb-2">Catatan Lengkap:</h3>
                <div class="bg-gray-100 p-4 rounded-lg border border-gray-200">
                    <p class="text-gray-800 leading-relaxed">{{ $emotionNote->note ?? 'Tidak ada catatan.' }}</p>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Musik Rekomendasi untuk Emosi Ini:</h3>
                @if($songs->count())
                    <ul class="space-y-3">
                        @foreach($songs as $song)
                            <li class="p-4 bg-blue-50 rounded-lg shadow-sm border border-blue-200 flex items-center space-x-3">
                                <span class="text-blue-500 text-xl">🎵</span>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">{{ $song->title }}</h3>
                                    <p class="text-gray-600 text-sm">{{ $song->artist }}</p>
                                    @if($song->link)
                                        <a href="{{ $song->link }}" target="_blank" class="text-blue-600 hover:underline text-sm font-medium block mt-1">Dengarkan di sini <i class="fas fa-external-link-alt text-xs ml-1"></i></a>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-center">Tidak ada lagu yang direkomendasikan untuk emosi ini.</p>
                @endif
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('rekomendasi') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-semibold py-2 px-6 rounded-full shadow-lg transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>

                {{-- Form untuk menghapus catatan emosi --}}
                <form action="{{ route('emotion.destroy', $emotionNote->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jurnal ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-800 text-white font-semibold py-2 px-6 rounded-full shadow-lg transition duration-200">
                        <i class="fas fa-trash-alt mr-2"></i> Hapus Jurnal
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Link Font Awesome untuk ikon --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection
