@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-white px-4 py-8 sm:px-6 lg:px-8">
    <!-- Header Greeting -->
    <div class="bg-gray-100 p-6 rounded-2xl shadow mb-8">
        <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900 mb-2 flex items-center gap-2">
            Hai, {{ Auth::user()->name }}! 
            <span class="animate-wave inline-block">👋🏻</span>
        </h1>
        <p class="text-gray-600">Selamat Datang</p>
    </div>

    <!-- Summary Box -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        <!-- Card: Users -->
        <a href="{{ route('admin.users.index') }}" 
           class="group bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition duration-300">
            <h2 class="text-lg sm:text-xl font-semibold text-gray-700 group-hover:text-indigo-600 transition mb-2">Total Users</h2>
            <p class="text-3xl sm:text-4xl font-bold text-gray-900 group-hover:text-indigo-600 transition">{{ $totalUsers }}</p>
        </a>

        <!-- Card: Songs -->
        <a href="{{ route('admin.songs.index') }}" 
           class="group bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition duration-300">
            <h2 class="text-lg sm:text-xl font-semibold text-gray-700 group-hover:text-green-600 transition mb-2">Total Songs</h2>
            <p class="text-3xl sm:text-4xl font-bold text-gray-900 group-hover:text-green-600 transition">{{ $totalSongs }}</p>
        </a>

        <!-- Card: Articles -->
        <a href="{{ route('admin.articles.index') }}" 
           class="group bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition duration-300">
            <h2 class="text-lg sm:text-xl font-semibold text-gray-700 group-hover:text-blue-600 transition mb-2">Total Articles</h2>
            <p class="text-3xl sm:text-4xl font-bold text-gray-900 group-hover:text-blue-600 transition">{{ $totalArticles }}</p>
        </a>
    </div>

    <!-- List Article -->
    <div class="bg-white border border-gray-200 rounded-xl shadow p-6">
        <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4">Latest Articles</h3>
        @if ($articles->count())
            <ul class="space-y-3">
                @foreach ($articles as $article)
                    <li class="border-b border-gray-200 pb-2">
                        <a href="{{ route('artikel.show', $article) }}" class="text-gray-900 hover:underline font-medium break-words">
                            {{ $article->title }}
                        </a>
                        <p class="text-gray-500 text-sm">Published {{ $article->created_at->diffForHumans() }}</p>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No articles available.</p>
        @endif
    </div>
</div>

<style>
@keyframes wave {
  0% { transform: rotate(0deg); }
  15% { transform: rotate(14deg); }
  30% { transform: rotate(-8deg); }
  40% { transform: rotate(14deg); }
  50% { transform: rotate(-4deg); }
  60% { transform: rotate(10deg); }
  70% { transform: rotate(0deg); }
  100% { transform: rotate(0deg); }
}
.animate-wave {
  display: inline-block;
  animation: wave 2s infinite;
  transform-origin: 70% 70%;
}
</style>
@endsection
