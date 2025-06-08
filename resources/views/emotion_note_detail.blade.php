@extends('layouts.app')

@section('content')
<div class="bg-cover bg-center min-h-screen py-12" style="background-image: url('{{ asset('images/bg-kuiz.jpg') }}');">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <h1 class="text-3xl mb-4 font-bold text-center text-white drop-shadow-lg">Detail Catatan Emosi Anda</h1>

        <div class="bg-white bg-opacity-90 backdrop-blur-md p-8 rounded-2xl shadow-lg mb-8 border border-gray-200">
            <div class="mb-6 pb-4 border-b border-gray-100">
                {{-- Menggunakan badge untuk emosi --}}
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-2">
                    <h2 class="text-2xl font-semibold text-gray-800">
                        Catatan Emosi
                    </h2>
                    @php
                        // Helper untuk warna tag emosi (dapat dipindahkan ke helper file terpisah)
                        function getEmotionTagColor($emotion) {
                            $emotion = strtolower($emotion);
                            switch ($emotion) {
                                case 'senang': return 'bg-yellow-100 text-yellow-800';
                                case 'sedih': return 'bg-blue-100 text-blue-800';
                                case 'marah': return 'bg-red-100 text-red-800';
                                case 'cemas': return 'bg-purple-100 text-purple-800';
                                case 'cinta': return 'bg-pink-100 text-pink-800';
                                case 'tenang': return 'bg-green-100 text-green-800';
                                default: return 'bg-gray-100 text-gray-800';
                            }
                        }
                    @endphp
                    <span class="px-3 py-1 rounded-full text-sm font-semibold {{ getEmotionTagColor($emotionNote->emotion) }} capitalize whitespace-nowrap mt-2 sm:mt-0">
                        {{ ucfirst($emotionNote->emotion) }}
                    </span>
                </div>
                <p class="text-gray-600 text-sm mb-4">{{ $emotionNote->created_at->isoFormat('DD MMMM YYYY, HH:mm') }} WIB</p>

                <h3 class="text-xl font-semibold text-gray-700 mb-2">Refleksi Kamu:</h3>
                <div class="bg-gray-100 p-4 rounded-xl border border-gray-200 shadow-inner">
                    <p class="text-gray-800 leading-relaxed">{{ $emotionNote->note ?? 'Tidak ada catatan.' }}</p>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Musik Rekomendasi untuk Emosi Ini:</h3>
                @if($songs->count())
                    <ul class="space-y-3">
                        @foreach($songs as $song)
                            <a href="{{ $song->link }}" target="_blank" class="block bg-gray-50 rounded-lg p-3 flex items-center justify-between border border-gray-200 hover:bg-gray-100 transition duration-200">
                                <div class="flex-1 min-w-0 pr-4">
                                    <p class="font-semibold text-gray-900 truncate" title="{{ $song->judul }}">{{ $song->judul }}</p>
                                    <p class="text-sm text-gray-600 truncate" title="{{ $song->artist }}">oleh {{ $song->artist }}</p>
                                </div>
                                 {{-- SVG Icon Play Baru --}}
                                <div class="text-blue-500 hover:text-blue-700 flex-shrink-0" style="width: 28px; height: 28px;">
                                    <svg viewBox="0 0 512 512" style="fill: currentColor;">
                                        <g>
                                            <path d="M256,0C114.625,0,0,114.625,0,256c0,141.374,114.625,256,256,256c141.374,0,256-114.626,256-256		C512,114.625,397.374,0,256,0z M351.062,258.898l-144,85.945c-1.031,0.626-2.344,0.657-3.406,0.031		c-1.031-0.594-1.687-1.702-1.687-2.937v-85.946v-85.946c0-1.218,0.656-2.343,1.687-2.938c1.062-0.609,2.375-0.578,3.406,0.031		l144,85.962c1.031,0.586,1.641,1.718,1.641,2.89C352.703,257.187,352.094,258.297,351.062,258.898z"/>
                                        </g>
                                    </svg>
                                </div>                            </a>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-center italic">Tidak ada lagu yang direkomendasikan untuk emosi ini.</p>
                @endif
            </div>

            {{-- Tombol aksi - Mengatur posisi kiri dan kanan --}}
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-6">
                {{-- Tombol Kembali - Kiri --}}
                <a href="{{ route('rekomendasi') }}"
                   class="inline-flex items-center bg-white hover:bg-gray-50 text-gray-700 font-semibold py-2 px-6 rounded-full shadow-md transition duration-200 w-full sm:w-auto justify-center">
                    Kembali
                </a>

                {{-- Tombol Hapus Jurnal - Kanan --}}
                <button type="button" onclick="showDeleteModal({{ $emotionNote->id }})"
                        class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-full shadow-md transition duration-200 w-full sm:w-auto justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    Hapus Jurnal
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