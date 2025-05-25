@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-10">
    <h2 class="text-3xl font-bold text-gray-800 mb-8">Riwayat Hasil Kuesioner</h2>

    @if ($history->isEmpty())
        <div class="bg-yellow-50 border-l-4 border-yellow-400 text-yellow-700 p-4 rounded-md shadow-sm">
            <p class="text-sm">Belum ada hasil kuesioner sebelumnya. Silakan isi kuesioner terlebih dahulu.</p>
        </div>
    @else
        <div class="space-y-6">
            @foreach ($history as $result)
            <div class="p-6 rounded-xl bg-white shadow-md hover:shadow-lg transition duration-300 border border-gray-100">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-xl font-semibold text-indigo-700">Hasil Kuesioner</h3>
                    <span class="text-sm text-gray-500">{{ $result->created_at->format('d M Y, H:i') }}</span>
                </div>
                <ul class="mt-4 space-y-1 text-gray-700 text-sm leading-relaxed">
                    <li><span class="font-medium text-gray-800">Skor Positive Affect (PA):</span> {{ $result->pa_score }}</li>
                    <li><span class="font-medium text-gray-800">Skor Negative Affect (NA):</span> {{ $result->na_score }}</li>
                    <li><span class="font-medium text-gray-800">Tipe Mood:</span> {{ $result->mood_type }}</li>
                </ul>
            </div>
            @endforeach
        </div>
    @endif

    <div class="mt-10">
        <a href="{{ route('panas.show') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 transition font-medium text-sm">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Kuesioner
        </a>
    </div>
</div>
@endsection
