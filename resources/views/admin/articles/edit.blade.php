@extends('layouts.admin')

@section('content')
<h1 class="text-3xl font-bold mb-6">Edit Artikel</h1>

<form action="{{ route('admin.articles.update', $article) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="title" class="block font-semibold mb-1">Judul Artikel</label>
    <input
        type="text"
        id="title"
        name="title"
        value="{{ old('title', $article->title) }}"
        class="w-full border border-gray-300 rounded p-2 mb-4"
        required
    >

    <label for="content" class="block font-semibold mb-1">Isi Artikel</label>
    <textarea id="content" name="content" rows="10" required>{{ old('content', $article->content) }}</textarea>

    <button type="submit" class="mt-4 bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700">Update Artikel</button>
</form>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
ClassicEditor
    .create(document.querySelector('#content'))
    .catch(error => console.error(error));
</script>
@endsection
