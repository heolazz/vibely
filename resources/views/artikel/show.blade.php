@extends('layouts.app')

@section('content')
<section class="py-24 bg-gradient-to-b from-blue-50/30 via-white to-white min-h-screen">
    <div class="max-w-3xl mx-auto px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="mb-8 text-sm text-gray-500">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1 hover:text-blue-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke daftar artikel
            </a>
        </nav>

        <!-- Judul -->
        <h1 class="text-4xl lg:text-5xl font-serif font-bold text-gray-900 mb-4 leading-snug">
            {{ $article->title }}
        </h1>

        <!-- Meta -->
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-12">
            <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">
                {{ $article->created_at->format('d M Y') }}
            </div>
        </div>

        <!-- Konten -->
        <article class="prose prose-lg prose-gray max-w-none bg-white rounded-3xl p-8 shadow-md hover:shadow-lg transition duration-300">
            {!! $article->content !!}
        </article>

        <!-- Tombol Kembali -->
        <div class="mt-16 text-center">
            <a href="{{ route('artikel.index') }}"
               class="inline-flex items-center gap-2 text-white bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-full shadow-lg transition transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Artikel Lainnya
            </a>
        </div>
    </div>
</section>
@endsection
