@extends('layouts.app')

@section('content')
<section class="bg-gradient-to-br from-white to-gray-100 py-14 sm:py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 text-center">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-900 tracking-tight">
            Semua <span class="text-indigo-600">Artikel</span>
        </h1>
        <p class="mt-4 text-base sm:text-lg text-gray-700 max-w-2xl mx-auto">
            Jelajahi berbagai artikel seputar kesehatan mental untuk mendukung perjalananmu.
        </p>
    </div>
</section>

<section class="bg-white py-12 sm:py-16">
    <div class="container mx-auto px-4 max-w-6xl">
        @if($articles->isEmpty())
            <p class="text-center text-gray-600 text-lg">Belum ada artikel yang tersedia saat ini.</p>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($articles as $article)
                    <a href="{{ route('artikel.show', $article->id) }}" class="bg-gray-50 rounded-xl shadow-md hover:shadow-lg transition p-6 block h-full flex flex-col justify-between">
                        <div>
                            <h3 class="font-semibold text-lg mb-2 text-gray-900">{{ $article->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $article->excerpt }}</p>
                        </div>
                        <div class="mt-4 text-right">
                            <span class="text-indigo-600 text-sm font-medium hover:underline">Baca Selengkapnya</span>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-10">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
</section>
@endsection