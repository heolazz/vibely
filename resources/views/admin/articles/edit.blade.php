@extends('layouts.admin')

@section('content')
<h1 class="text-3xl font-bold mb-6">Edit Artikel</h1>

<form action="{{ route('admin.articles.update', $article) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="title" class="block font-semibold mb-1">Judul Artikel</label>
        <input
            type="text"
            id="title"
            name="title"
            value="{{ old('title', $article->title) }}"
            class="w-full border border-gray-300 rounded p-2"
            required
        >
        @error('title')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Kategori Artikel --}}
    <div class="mb-4">
        <label for="category" class="block font-semibold mb-1">Kategori Artikel</label>
        <select
            id="category"
            name="category"
            class="w-full border border-gray-300 rounded p-2"
            required {{-- Ubah menjadi required jika kategori wajib diisi --}}
        >
            <option value="">-- Pilih Kategori --</option>
            <option value="Mengenali Emosi" {{ old('category', $article->category) == 'Mengenali Emosi' ? 'selected' : '' }}>Mengenali Emosi</option>
            <option value="Jurnal Emosi" {{ old('category', $article->category) == 'Jurnal Emosi' ? 'selected' : '' }}>Jurnal Emosi</option>
            <option value="Musik dan Emosi" {{ old('category', $article->category) == 'Musik dan Emosi' ? 'selected' : '' }}>Musik dan Emosi</option>
            <option value="Mood Tracker & Self Care" {{ old('category', $article->category) == 'Mood Tracker & Self Care' ? 'selected' : '' }}>Mood Tracker & Self Care</option>
            {{-- Tambahkan kategori lain di sini jika ada --}}
        </select>
        @error('category')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="excerpt" class="block font-semibold mb-1">Cuplikan Artikel (Ringkasan singkat)</label>
        <textarea
            id="excerpt"
            name="excerpt"
            rows="3"
            class="w-full border border-gray-300 rounded p-2"
        >{{ old('excerpt', $article->excerpt) }}</textarea>
        @error('excerpt')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="content" class="block font-semibold mb-1">Isi Artikel</label>
        <textarea
            id="content"
            name="content"
            class="w-full border border-gray-300 rounded p-2"
            required
        >{{ old('content', $article->content) }}</textarea>
        @error('content')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="mt-4 bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700">Update Artikel</button>
</form>

@endsection

@section('scripts') {{-- Pastikan bagian ini ada di layout Anda --}}
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    let editorInstance;
    ClassicEditor
        .create(document.querySelector('#content'))
        .then(editor => {
            editorInstance = editor;
        })
        .catch(error => {
            console.error('CKEditor error:', error);
        });

    // Sinkronkan CKEditor data sebelum submit
    document.querySelector('form').addEventListener('submit', function (e) {
        // Hanya sinkronkan jika editorInstance sudah ada
        if (editorInstance) {
            document.querySelector('#content').value = editorInstance.getData();
        }
    });
</script>
@endsection