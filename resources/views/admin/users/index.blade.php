@extends('layouts.admin')

@section('content')
<div class="bg-white min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <h1 class="text-3xl font-bold text-gray-800">👥 Manajemen Pengguna</h1>
            <a href="{{ route('admin.users.create') }}"
               class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-5 rounded-lg shadow transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Pengguna
            </a>
        </div>

        <!-- Notifikasi -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-100 border border-green-300 text-green-800 shadow">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel (Desktop) -->
        <div class="hidden md:block overflow-x-auto bg-white shadow-xl ring-1 ring-black ring-opacity-5 rounded-xl">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-indigo-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wide">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wide">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wide">Role</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 capitalize">{{ $user->role }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                       class="inline-flex items-center text-yellow-700 bg-yellow-100 hover:bg-yellow-200 px-3 py-1 rounded-md text-xs font-medium shadow-sm transition">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center text-red-700 bg-red-100 hover:bg-red-200 px-3 py-1 rounded-md text-xs font-medium shadow-sm transition">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-6 text-center text-gray-500 text-sm">Belum ada pengguna terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile (Cards) -->
        <div class="md:hidden space-y-4">
            @forelse($users as $user)
                <div class="bg-white rounded-xl shadow p-4">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $user->name }}</h3>
                    <p class="text-sm text-gray-600 mt-1"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="text-sm text-gray-600 mt-1"><strong>Role:</strong> <span class="capitalize">{{ $user->role }}</span></p>
                    <div class="mt-4 flex gap-3 flex-wrap">
                        <a href="{{ route('admin.users.edit', $user->id) }}"
                           class="inline-flex items-center text-yellow-700 bg-yellow-100 hover:bg-yellow-200 px-3 py-1 rounded-md text-xs font-medium shadow-sm transition">
                            ✏️ Edit
                        </a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus user ini?')" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center text-red-700 bg-red-100 hover:bg-red-200 px-3 py-1 rounded-md text-xs font-medium shadow-sm transition">
                                🗑️ Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 text-sm">Belum ada pengguna terdaftar.</p>
            @endforelse
        </div>

        <!-- Jika menggunakan pagination, tambahkan di sini -->
        {{-- 
        <div class="mt-6">
            {{ $users->links() }}
        </div>
        --}}
    </div>
</div>
@endsection
