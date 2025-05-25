@extends('layouts.admin')

@section('content')
<div class="container mx-auto max-w-xl px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Data Pengguna</h1>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-700 border border-red-200 rounded">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6 bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="name" id="name"
                   value="{{ old('name', $user->name) }}"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                   required>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email"
                   value="{{ old('email', $user->email) }}"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                   required>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password Baru <span class="text-gray-400 text-xs">(opsional)</span></label>
            <input type="password" name="password" id="password"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('admin.users.index') }}"
               class="text-sm text-gray-600 hover:text-indigo-600 underline transition">
                ← Kembali ke daftar user
            </a>

            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-md shadow transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
