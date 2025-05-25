@extends('layouts.admin')

@section('content')
<h1 class="text-3xl font-bold mb-6">Tambah Artikel Baru</h1>

<form action="{{ route('admin.articles.store') }}" method="POST">
    @csrf

    <label for="title" class="block font-semibold mb-1">Judul Artikel</label>
    <input
        type="text"
        id="title"
        name="title"
        value="{{ old('title') }}"
        class="w-full border border-gray-300 rounded p-2 mb-4"
        required
    >

    <label for="content" class="block font-semibold mb-1">Isi Artikel</label>
    <textarea
        id="content"
        name="content"
        class="w-full border border-gray-300 rounded p-2 mb-4"
    
    >{{ old('content') }}</textarea>

    <button type="submit" class="mt-4 bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
        Simpan Artikel
    </button>
</form>
@endsection

@section('scripts')
<!-- CKEditor CDN -->
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

    // Optional: Sinkronkan sebelum submit kalau perlu (biasanya CKEditor 5 otomatis)
    document.querySelector('form').addEventListener('submit', function (e) {
        document.querySelector('#content').value = editorInstance.getData();
    });
</script>
@endsection
