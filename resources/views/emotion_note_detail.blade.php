@extends('layouts.app')

@section('content')
<div class="bg-cover bg-center min-h-screen py-12" style="background-image: url('{{ asset('images/bg-kuiz.jpg') }}');">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h1 class="text-3xl mb-4 font-bold text-center text-white drop-shadow-lg">Detail Catatan Emosi Anda</h1>

        <div class="bg-white bg-opacity-90 backdrop-blur-md p-8 rounded-lg shadow-md mb-8">
            <div class="mb-6 border-b pb-4">
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Emosi: <span class="capitalize text-blue-600">{{ ucfirst($emotionNote->emotion) }}</span></h2>
                <p class="text-gray-600 text-sm mb-4">{{ $emotionNote->created_at->format('d M Y, H:i') }}</p>

                <h3 class="text-xl font-semibold text-gray-700 mb-2">Catatan Lengkap:</h3>
                <div class="bg-gray-100 p-4 rounded-lg border border-gray-200">
                    <p class="text-gray-800 leading-relaxed">{{ $emotionNote->note ?? 'Tidak ada catatan.' }}</p>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Musik Rekomendasi untuk Emosi Ini:</h3>
                @if($songs->count())
                    <ul class="space-y-3">
                        @foreach($songs as $song)
                            <li class="p-4 bg-blue-50 rounded-lg shadow-sm border border-blue-200 flex items-center space-x-3">
                                <span class="text-blue-500 text-xl">🎵</span>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">{{ $song->title }}</h3>
                                    <p class="text-gray-600 text-sm">{{ $song->artist }}</p>
                                    @if($song->link)
                                        <a href="{{ $song->link }}" target="_blank" class="text-blue-600 hover:underline text-sm font-medium block mt-1">Dengarkan di sini <i class="fas fa-external-link-alt text-xs ml-1"></i></a>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-center">Tidak ada lagu yang direkomendasikan untuk emosi ini.</p>
                @endif
            </div>

            {{-- Perbaikan untuk tampilan mobile button --}}
            <div class="flex flex-col md:flex-row justify-center md:justify-between items-center gap-4 mt-6">
                <a href="{{ route('rekomendasi') }}"
                   class="w-full md:w-auto bg-gray-500 hover:bg-gray-700 text-white text-xs font-semibold py-2 px-6 rounded-full shadow-lg transition duration-200 text-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>

                {{-- Tombol untuk memicu modal konfirmasi hapus --}}
                <button type="button" onclick="showDeleteModal({{ $emotionNote->id }})"
                        class="w-full md:w-auto bg-red-600 hover:bg-red-800 text-white text-xs font-semibold py-2 px-6 rounded-full shadow-lg transition duration-200">
                    <i class="fas fa-trash-alt mr-2"></i> Hapus Jurnal
                </button>

                {{-- Form hapus yang akan disubmit via JS --}}
                <form id="delete-form-{{ $emotionNote->id }}" action="{{ route('emotion.destroy', $emotionNote->id) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi Hapus --}}
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-sm">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Konfirmasi Penghapusan</h3>
        <p class="text-gray-700 mb-6">Apakah Anda yakin ingin menghapus jurnal ini? Tindakan ini tidak dapat dibatalkan.</p>
        <div class="flex justify-end space-x-3">
            <button type="button" onclick="hideDeleteModal()"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-full hover:bg-gray-300 transition duration-200 text-sm font-medium">
                Batal
            </button>
            <button type="button" id="confirmDeleteButton"
                    class="px-4 py-2 bg-red-600 text-white rounded-full hover:bg-red-700 transition duration-200 text-sm font-medium">
                Ya, Hapus
            </button>
        </div>
    </div>
</div>

{{-- Link Font Awesome untuk ikon --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<script>
    let currentNoteIdToDelete = null; // Variabel untuk menyimpan ID jurnal yang akan dihapus

    function showDeleteModal(noteId) {
        currentNoteIdToDelete = noteId;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function hideDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        currentNoteIdToDelete = null;
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Event listener untuk tombol 'Ya, Hapus' di dalam modal
        const confirmButton = document.getElementById('confirmDeleteButton');
        if (confirmButton) {
            confirmButton.addEventListener('click', function() {
                if (currentNoteIdToDelete) {
                    // Submit form penghapusan yang sesuai
                    document.getElementById('delete-form-' + currentNoteIdToDelete).submit();
                }
            });
        }

        // Opsional: Tutup modal jika mengklik di luar area modal
        const deleteModal = document.getElementById('deleteModal');
        if (deleteModal) {
            deleteModal.addEventListener('click', function(event) {
                if (event.target === deleteModal) {
                    hideDeleteModal();
                }
            });
        }
    });
</script>
@endsection
