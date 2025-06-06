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

        {{-- Filter Kategori --}}
        <div class="mb-10">
            <div class="flex flex-wrap justify-start sm:justify-center gap-2 sm:gap-4 overflow-x-auto">
                {{-- Tombol "Semua" --}}
                <a href="{{ route('artikel.index') }}"
                   class="px-4 py-2 rounded-full border border-gray-300 text-gray-700 hover:bg-indigo-100 hover:border-indigo-400 transition duration-300
                   {{ !request()->has('category') || request('category') === '' ? 'bg-indigo-600 text-white border-indigo-600' : '' }}">
                    Semua
                </a>

                {{-- Kategori lainnya --}}
                @php
                    $categories = [
                        ['label' => 'Mengenali Emosi', 'slug' => 'mengenali-emosi'],
                        ['label' => 'Jurnal Emosi', 'slug' => 'jurnal-emosi'],
                        ['label' => 'Musik dan Emosi', 'slug' => 'musik-dan-emosi'],
                        ['label' => 'Mood Tracker & Self Care', 'slug' => 'mood-tracker-&-self-care'],
                    ];
                @endphp

                @foreach ($categories as $cat)
                    <a href="{{ route('artikel.index', ['category' => $cat['slug']]) }}"
                       class="px-4 py-2 rounded-full border border-gray-300 text-gray-700 hover:bg-indigo-100 hover:border-indigo-400 transition duration-300
                       {{ request('category') === $cat['slug'] ? 'bg-indigo-600 text-white border-indigo-600' : '' }}">
                        {{ $cat['label'] }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Daftar Artikel --}}
        @if($articles->isEmpty())
            <p class="text-center text-gray-600 text-lg">Belum ada artikel yang tersedia untuk kategori ini.</p>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($articles as $article)
                    <div class="bg-white rounded-xl shadow-md border border-gray-200 hover:shadow-lg transition flex flex-col p-6">
                        <div class="flex justify-between items-center text-xs text-gray-500 mb-4">
                            <span class="font-semibold uppercase text-gray-700">
                                {{ Str::headline($article->category ?? 'UMUM') }}
                            </span>
                            <span>{{ $article->created_at->format('d M Y') }}</span>
                        </div>

                        <h3 class="font-bold text-xl text-gray-900 mb-3 leading-tight">
                            {{ $article->title }}
                        </h3>

                        <p class="text-sm text-gray-600 flex-grow mb-6">
                            {{ $article->excerpt }}
                        </p>

                        <a href="{{ route('artikel.show', $article->id) }}"
                           class="mt-auto bg-indigo-600 text-white text-center px-6 py-2 rounded-md font-semibold hover:bg-indigo-700 transition duration-300 w-fit">
                            Baca
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mt-10">
                {{-- Penting: appends() untuk mempertahankan parameter kategori saat paginasi --}}
                {{ $articles->appends(['category' => request('category')])->links() }}
            </div>
        @endif
    </div>
</section>
@endsection