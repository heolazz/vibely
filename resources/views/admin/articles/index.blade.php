@extends('layouts.admin')

@section('content')
<div class="bg-white min-h-screen py-12">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <h1 class="text-3xl font-bold text-gray-800">📰 Daftar Artikel</h1>
            <a href="{{ route('admin.articles.create') }}"
               class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Artikel
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-100 border border-green-300 text-green-800 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if($articles->count())
        <div class="hidden md:block overflow-x-auto bg-white shadow-md rounded-xl ring-1 ring-black ring-opacity-5">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-indigo-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategori</th> {{-- Tambah kolom kategori --}}
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($articles as $article)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $article->title }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $article->category ?? 'N/A' }}</td> {{-- Tampilkan kategori --}}
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $article->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm text-center">
                            <div class="flex justify-center gap-2 flex-wrap">
                                <a href="{{ route('artikel.show', $article) }}" target="_blank"
                                   class="inline-flex items-center bg-indigo-100 hover:bg-indigo-200 text-indigo-700 px-3 py-1 rounded-md text-xs font-medium shadow-sm transition">
                                    👁️ Lihat
                                </a>
                                <a href="{{ route('admin.articles.edit', $article) }}"
                                   class="inline-flex items-center bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-1 rounded-md text-xs font-medium shadow-sm transition">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST"
                                      onsubmit="return confirm('Hapus artikel ini?');" class="inline-block">
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

        <div class="md:hidden space-y-4">
            @foreach($articles as $article)
            <div class="bg-white rounded-xl shadow p-4">
                <h3 class="text-lg font-semibold text-gray-800">{{ $article->title }}</h3>
                <p class="text-sm text-gray-600 mt-1"><strong>Kategori:</strong> {{ $article->category ?? 'N/A' }}</p> {{-- Tampilkan kategori --}}
                <p class="text-sm text-gray-600 mt-1"><strong>Tanggal:</strong> {{ $article->created_at->format('d M Y') }}</p>
                <div class="mt-3 flex flex-wrap gap-2">
                    <a href="{{ route('artikel.show', $article) }}" target="_blank"
                       class="inline-flex items-center bg-indigo-100 hover:bg-indigo-200 text-indigo-700 px-3 py-1 rounded-md text-xs font-medium shadow-sm transition">
                        👁️ Lihat
                    </a>
                    <a href="{{ route('admin.articles.edit', $article) }}"
                       class="inline-flex items-center bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-1 rounded-md text-xs font-medium shadow-sm transition">
                        ✏️ Edit
                    </a>
                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST"
                          onsubmit="return confirm('Hapus artikel ini?');" class="inline-block">
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

        <div class="mt-6">
            {{ $articles->links() }}
        </div>
        @else
            <p class="text-gray-600 mt-6">Belum ada artikel yang ditambahkan.</p>
        @endif
    </div>
</div>
@endsection