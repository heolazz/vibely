{{-- resources/views/music_recommendations/index.blade.php --}}
@extends('layouts.app')

@section('content')
<section class="bg-white py-8 sm:py-10 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 w-full">
        <h1 class="text-3xl sm:text-4xl md:text-4xl font-extrabold text-gray-900 tracking-tight text-center mb-8">
            Daftar Rekomendasi Musik
        </h1>

        {{-- Filter Kategori --}}
        <div class="mb-10">
            <div class="flex flex-nowrap justify-start sm:justify-center gap-2 sm:gap-4 overflow-x-auto pb-3 custom-scrollbar">
                {{-- Tombol "Semua" --}}
                <a href="{{ route('musik.daftar') }}"
                   class="flex-shrink-0 px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap
                           {{ !$selectedSlug || $selectedSlug === 'semua' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}
                           transition duration-200"
                >
                    Semua
                </a>

                {{-- Kategori lainnya --}}
                @php
                    $musicCategories = [
                        ['label' => 'Senang', 'slug' => 'senang'],
                        ['label' => 'Sedih', 'slug' => 'sedih'],
                        ['label' => 'Marah', 'slug' => 'marah'],
                        ['label' => 'Cemas', 'slug' => 'cemas'],
                        ['label' => 'Cinta', 'slug' => 'cinta'],
                        ['label' => 'Tenang', 'slug' => 'tenang'],
                    ];
                @endphp

                @foreach($musicCategories as $cat)
                    <a href="{{ route('musik.daftar', ['category' => $cat['slug']]) }}"
                       class="flex-shrink-0 px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap
                               {{ $selectedSlug === $cat['slug'] ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}
                               transition duration-200"
                    >
                        {{ $cat['label'] }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Daftar Lagu --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($paginatedSongs as $song)
                <a href="{{ $song->display_url }}" target="_blank" class="block bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                    <div class="flex items-center p-4">
                        {{-- Album cover dan placeholder ikon musik dihapus dari sini --}}
                        {{-- <div class="w-16 h-16 rounded-lg bg-blue-100 flex items-center justify-center mr-4 text-blue-600 text-2xl shadow-sm flex-shrink-0">
                            🎶
                        </div> --}}

                        <div class="flex-grow">
                            <p class="text-base font-semibold text-gray-900 truncate">{{ $song->display_title }}</p>
                            <p class="text-sm text-gray-600 truncate mb-1">{{ $song->display_artist }}</p>
                            @if($song->category_value)
                                <span class="inline-flex items-center rounded-full bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-700 mt-1">
                                    {{ $song->category_value }}
                                </span>
                            @endif
                        </div>
                        {{-- SVG Icon Play --}}
                        <div class="ml-4 text-blue-500 hover:text-blue-700 flex-shrink-0" style="width: 28px; height: 28px;">
                            <svg viewBox="0 0 512 512" style="fill: currentColor;">
                                <g>
                                    <path d="M256,0C114.625,0,0,114.625,0,256c0,141.374,114.625,256,256,256c141.374,0,256-114.626,256-256		C512,114.625,397.374,0,256,0z M351.062,258.898l-144,85.945c-1.031,0.626-2.344,0.657-3.406,0.031		c-1.031-0.594-1.687-1.702-1.687-2.937v-85.946v-85.946c0-1.218,0.656-2.343,1.687-2.938c1.062-0.609,2.375-0.578,3.406,0.031		l144,85.962c1.031,0.586,1.641,1.718,1.641,2.89C352.703,257.187,352.094,258.297,351.062,258.898z"/>
                                </g>
                            </svg>
                        </div>
                    </div>
                </a>
            @empty
                <p class="col-span-full text-center text-gray-600 italic py-10">Tidak ada lagu yang ditemukan untuk kategori ini.</p>
            @endforelse
        </div>

        {{-- Tautan Paginasi --}}
        <div class="mt-10">
            {{ $paginatedSongs->links() }}
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Custom scrollbar untuk elemen filter kategori */
    .custom-scrollbar::-webkit-scrollbar {
        height: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #a0aec0;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #718096;
    }

    /* Untuk Firefox */
    .custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #a0aec0 #f1f1f1;
    }
</style>
@endpush