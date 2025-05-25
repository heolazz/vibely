@extends('layouts.admin')

@section('content')
<div class="bg-white min-h-screen py-12">
    <div class="max-w-6xl mx-auto px-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <h1 class="text-3xl font-bold text-gray-800">🎵 Daftar Lagu</h1>
            <a href="{{ route('admin.songs.create') }}"
               class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Musik
            </a>
        </div>

        <!-- Notifikasi -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-100 border border-green-300 text-green-800 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel (Desktop) -->
        @if($songs->count())
        <div class="hidden md:block overflow-x-auto bg-white shadow-md rounded-xl ring-1 ring-black ring-opacity-5">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-indigo-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Artis</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Link</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Emosi</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($songs as $song)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $song->judul }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $song->artist ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-center">
                            @if($song->link)
                                <a href="{{ $song->link }}" target="_blank"
                                   class="inline-flex items-center bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-1 rounded-md text-xs font-medium shadow-sm transition">
                                    🔗 Buka Link
                                </a>
                            @else
                                <span class="text-gray-400 text-xs">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $song->emotion ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-center">
                            <div class="flex justify-center gap-2 flex-wrap">
                                <a href="{{ route('admin.songs.edit', $song) }}"
                                   class="inline-flex items-center bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-1 rounded-md text-xs font-medium shadow-sm transition">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('admin.songs.destroy', $song) }}" method="POST"
                                      onsubmit="return confirm('Hapus lagu ini?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center bg-red-100 hover:bg-red-200 text-red-600 px-3 py-1 rounded-md text-xs font-medium shadow-sm transition">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile (Cards) -->
        <div class="md:hidden space-y-4">
            @foreach($songs as $song)
            <div class="bg-white rounded-xl shadow p-4">
                <h3 class="text-lg font-semibold text-gray-800">{{ $song->judul }}</h3>
                <p class="text-sm text-gray-600 mt-1"><strong>Artis:</strong> {{ $song->artist ?? '-' }}</p>
                <p class="text-sm text-gray-600 mt-1"><strong>Emosi:</strong> {{ $song->emotion ?? '-' }}</p>
                <div class="mt-2">
                    @if($song->link)
                        <a href="{{ $song->link }}" target="_blank"
                           class="inline-flex items-center bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-1 rounded-md text-xs font-medium shadow-sm transition">
                            🔗 Buka Link
                        </a>
                    @else
                        <span class="text-gray-400 text-xs">Link tidak tersedia</span>
                    @endif
                </div>
                <div class="mt-3 flex flex-wrap gap-2">
                    <a href="{{ route('admin.songs.edit', $song) }}"
                       class="inline-flex items-center bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-1 rounded-md text-xs font-medium shadow-sm transition">
                        ✏️ Edit
                    </a>
                    <form action="{{ route('admin.songs.destroy', $song) }}" method="POST"
                          onsubmit="return confirm('Hapus lagu ini?');" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center bg-red-100 hover:bg-red-200 text-red-600 px-3 py-1 rounded-md text-xs font-medium shadow-sm transition">
                            🗑️ Hapus
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $songs->links() }}
        </div>
        @else
            <p class="text-gray-600 mt-6">Belum ada lagu yang ditambahkan.</p>
        @endif
    </div>
</div>
@endsection
