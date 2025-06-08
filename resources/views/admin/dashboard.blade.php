@extends('layouts.admin')

@section('content')
<div class="flex-1 p-4 sm:p-6 lg:p-8 bg-white min-h-screen">
    <div class="bg-white p-6 rounded-2xl shadow mb-8">
        <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900 mb-2 flex items-center gap-2">
            Hai, {{ Auth::user()->name }}! 
            <span class="animate-wave inline-block">👋🏻</span>
        </h1>
        <p class="text-gray-600">Selamat Datang</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        <a href="{{ route('admin.users.index') }}" 
           class="group bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition duration-300 flex items-center">
            <div class="p-3 bg-indigo-100 rounded-full mr-4">
                <svg class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div>
                <h2 class="text-lg sm:text-xl font-semibold text-gray-700 group-hover:text-indigo-600 transition mb-1">Total Users</h2>
                <p class="text-3xl sm:text-4xl font-bold text-gray-900 group-hover:text-indigo-600 transition">{{ $totalUsers }}</p>
            </div>
        </a>

        <a href="{{ route('admin.songs.index') }}" 
           class="group bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition duration-300 flex items-center">
            <div class="p-3 bg-pink-100 rounded-full mr-4">
                {{-- SVG Not Musik DENGAN BENTUK KOTAK MEMBULAT dari input Anda --}}
                <svg class="h-6 w-6 text-pink-600" fill="currentColor" viewBox="0,0,256,256">
                    <g fill="currentColor" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M37,4h-24c-4.962,0 -9,4.037 -9,9v24c0,4.963 4.038,9 9,9h24c4.962,0 9,-4.037 9,-9v-24c0,-4.963 -4.038,-9 -9,-9zM35,27v4v0.021h-0.002c-0.012,2.747 -2.249,4.979 -4.998,4.979h-0.5c-0.987,0 -1.933,-0.42 -2.596,-1.152c-0.662,-0.731 -0.985,-1.718 -0.887,-2.705c0.178,-1.763 1.77,-3.143 3.626,-3.143h1.357c1.103,0 2,-0.897 2,-2v-9.795l-12,2.25v10.545v4c0,2.757 -2.243,5 -5,5h-0.5c-0.987,0 -1.933,-0.42 -2.596,-1.152c-0.662,-0.731 -0.985,-1.718 -0.887,-2.705c0.178,-1.763 1.77,-3.143 3.626,-3.143h1.357c1.103,0 2,-0.897 2,-2v-14.647c0,-0.963 0.687,-1.79 1.633,-1.966l12.591,-2.36c0.439,-0.083 0.891,0.033 1.234,0.319c0.345,0.286 0.542,0.707 0.542,1.154z"></path></g></g>
                </svg>
            </div>
            <div>
                <h2 class="text-lg sm:text-xl font-semibold text-gray-700 group-hover:text-pink-600 transition mb-1">Total Songs</h2>
                <p class="text-3xl sm:text-4xl font-bold text-gray-900 group-hover:text-pink-600 transition">{{ $totalSongs }}</p>
            </div>
        </a>

        <a href="{{ route('admin.articles.index') }}" 
           class="group bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition duration-300 flex items-center">
            <div class="p-3 bg-blue-100 rounded-full mr-4">
                {{-- Ikon Dokumen Teks Heroicons --}}
                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <h2 class="text-lg sm:text-xl font-semibold text-gray-700 group-hover:text-blue-600 transition mb-1">Total Articles</h2>
                <p class="text-3xl sm:text-4xl font-bold text-gray-900 group-hover:text-blue-600 transition">{{ $totalArticles }}</p>
            </div>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
        <div class="bg-white border border-gray-200 rounded-xl shadow p-6">
            <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4">Latest Articles</h3>
            @if ($articles->count())
                <div class="max-h-64 overflow-y-auto pr-2">
                    <ul class="space-y-3">
                        @foreach ($articles as $article)
                            <li class="border-b border-gray-200 pb-2 flex justify-between items-start">
                                <div class="flex-1 mr-4">
                                    <a href="{{ route('artikel.show', $article) }}" class="text-gray-900 hover:underline font-medium break-words">
                                        {{ $article->title }}
                                    </a>
                                    <p class="text-gray-500 text-sm">Published {{ $article->created_at?->diffForHumans() ?? 'N/A' }}</p>
                                </div>
                                @if($article->category)
                                    @php
                                        $categoryColor = App\Helpers\DashboardHelper::getCategoryTagColor($article->category);
                                    @endphp
                                    <span class="whitespace-nowrap px-2.5 py-0.5 text-xs font-medium {{ $categoryColor }} rounded-full">
                                        {{ $article->category }}
                                    </span>
                                @endif
                                {{-- Aksi Edit/Delete dihapus dari sini --}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <p class="text-gray-500">No articles available.</p>
            @endif
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow p-6">
            <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4">Latest Songs</h3>
            @if ($songs->count())
                <div class="max-h-64 overflow-y-auto pr-2">
                    <ul class="space-y-3">
                        @foreach ($songs as $song)
                            <li class="border-b border-gray-200 pb-2 flex justify-between items-start">
                                <div class="flex-1 mr-4">
                                    <span class="text-gray-900 font-medium break-words block">{{ $song->judul }}</span>
                                    <p class="text-gray-500 text-sm">by {{ $song->artist ?? 'Unknown Artist' }}</p>
                                    <p class="text-gray-500 text-xs">Added {{ $song->created_at?->diffForHumans() ?? 'N/A' }}</p>
                                </div>
                                @if($song->emotion)
                                    @php
                                        $emotionColor = App\Helpers\DashboardHelper::getEmotionTagColor($song->emotion);
                                    @endphp
                                    <span class="whitespace-nowrap px-2.5 py-0.5 text-xs font-medium {{ $emotionColor }} rounded-full">
                                        {{ $song->emotion }}
                                    </span>
                                @endif
                                {{-- Aksi Edit/Delete dihapus dari sini --}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <p class="text-gray-500">No songs available.</p>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
        <div class="bg-white border border-gray-200 rounded-xl shadow p-6">
            <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4">Recent Activity</h3>
            @if ($latestUsers->count())
                <div class="max-h-64 overflow-y-auto pr-2">
                    <ul class="space-y-3">
                        @foreach ($latestUsers as $user)
                            <li class="border-b border-gray-200 pb-2 flex items-center">
                                <div class="p-1 bg-indigo-50 rounded-full mr-3">
                                    {{-- Ikon Pengguna Heroicons --}}
                                    <svg class="h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-900 font-medium">
                                        <span class="text-indigo-600">{{ $user->name }}</span> registered.
                                    </p>
                                    <p class="text-gray-500 text-sm">Joined {{ $user->created_at?->diffForHumans() ?? 'N/A' }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <p class="text-gray-500">No recent activity.</p>
            @endif
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow p-6">
            <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4">Quick Stats</h3>
            <div class="grid grid-cols-1 gap-4">
                <div class="bg-blue-50 p-4 rounded-lg border border-blue-200 flex items-center shadow-sm">
                    <div class="p-2 bg-blue-100 rounded-full mr-3">
                        {{-- Ikon Dokumen Teks Heroicons --}}
                        <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-700">Articles Published Today</p>
                        <p class="text-xl font-bold text-blue-800">{{ $articlesToday }}</p>
                    </div>
                </div>

                <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-200 flex items-center shadow-sm">
                    <div class="p-2 bg-indigo-100 rounded-full mr-3">
                        {{-- Ikon Pengguna Heroicons --}}
                        <svg class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-700">New Users This Week</p>
                        <p class="text-xl font-bold text-indigo-800">{{ \App\Models\User::whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()])->count() }}</p>
                    </div>
                </div>

                <div class="bg-pink-50 p-4 rounded-lg border border-pink-200 flex items-center shadow-sm">
                    <div class="p-2 bg-pink-100 rounded-full mr-3">
                        <svg class="h-5 w-5 text-pink-600" fill="currentColor" viewBox="0,0,256,256">
                            <g fill="currentColor" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M37,4h-24c-4.962,0 -9,4.037 -9,9v24c0,4.963 4.038,9 9,9h24c4.962,0 9,-4.037 9,-9v-24c0,-4.963 -4.038,-9 -9,-9zM35,27v4v0.021h-0.002c-0.012,2.747 -2.249,4.979 -4.998,4.979h-0.5c-0.987,0 -1.933,-0.42 -2.596,-1.152c-0.662,-0.731 -0.985,-1.718 -0.887,-2.705c0.178,-1.763 1.77,-3.143 3.626,-3.143h1.357c1.103,0 2,-0.897 2,-2v-9.795l-12,2.25v10.545v4c0,2.757 -2.243,5 -5,5h-0.5c-0.987,0 -1.933,-0.42 -2.596,-1.152c-0.662,-0.731 -0.985,-1.718 -0.887,-2.705c0.178,-1.763 1.77,-3.143 3.626,-3.143h1.357c1.103,0 2,-0.897 2,-2v-14.647c0,-0.963 0.687,-1.79 1.633,-1.966l12.591,-2.36c0.439,-0.083 0.891,0.033 1.234,0.319c0.345,0.286 0.542,0.707 0.542,1.154z"></path></g></g>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-700">Songs Added This Month</p>
                        <p class="text-xl font-bold text-pink-800">{{ \App\Models\Song::whereMonth('created_at', now()->month)->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Inline Style untuk animasi wave --}}
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