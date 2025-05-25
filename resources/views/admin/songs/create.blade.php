@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-white p-8 max-w-xl mx-auto">
    <h1 class="text-3xl font-semibold text-gray-900 mb-6">Add New Song</h1>

    <form action="{{ route('admin.songs.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="title" class="block text-gray-700 font-medium mb-1">Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" id="title" value="{{ old('judul') }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('title')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="artist" class="block text-gray-700 font-medium mb-1">Artist</label>
            <input type="text" name="artist" id="artist" value="{{ old('artist') }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('artist')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="link" class="block text-gray-700 font-medium mb-1">Link</label>
            <input type="url" name="link" id="link" value="{{ old('link') }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="https://example.com/song-link">
            @error('link')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="emotion" class="block text-gray-700 font-medium mb-1">Emotion</label>
            <input type="text" name="emotion" id="emotion" value="{{ old('emotion') }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g. happy, sad, calm">
            @error('emotion')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.songs.index') }}" class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-100">Cancel</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Save</button>
        </div>
    </form>
</div>
@endsection
