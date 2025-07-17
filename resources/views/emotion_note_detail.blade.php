@extends('layouts.app')

@section('content')
<style>
    .info-term {
        cursor: help; /* Mengubah kursor menjadi tanda tanya */
        border-bottom: 1px dotted #3b82f6; /* Garis bawah putus-putus biru */
        color: #3b82f6; /* Warna teks biru */
        font-weight: 600; /* Sedikit lebih tebal */
    }
    .info-term:hover {
        color: #1d4ed8; /* Warna biru lebih gelap saat hover */
    }

    /* Styling untuk modal popup agar terlihat seperti sticker */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6); /* Sedikit lebih gelap */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.4s ease, visibility 0.4s ease; /* Transisi lebih lambat */
    }
    .modal-overlay.show {
        opacity: 1;
        visibility: visible;
    }
    .modal-content {
        background-color: #fefefe; /* Warna dasar agak off-white */
        padding: 2.5rem; /* Padding lebih besar */
        border-radius: 1.5rem; /* Border radius lebih membulat */
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3), /* Shadow utama */
                    0 0 0 5px rgba(255, 255, 255, 0.5); /* Border luar putih tipis */
        max-width: 480px; /* Lebar maksimum sedikit disesuaikan */
        width: 90%;
        position: relative; /* Diperlukan untuk pseudo-element */
        transform: scale(0.8) rotateX(15deg); /* Efek awal 3D: sedikit lebih kecil & miring */
        opacity: 0;
        transition: transform 0.4s ease-out, opacity 0.4s ease-out; /* Transisi untuk masuk */
        perspective: 1000px; /* Untuk efek 3D */
    }
    .modal-overlay.show .modal-content {
        transform: scale(1) rotateX(0deg); /* Kembali ke ukuran normal & tidak miring */
        opacity: 1;
    }

    /* Efek visual tambahan seperti 'tempelan' */
    .modal-content::before {
        content: '';
        position: absolute;
        top: -10px;
        left: 50%;
        transform: translateX(-50%) rotate(5deg); /* Pita atau bagian atas sticker */
        width: 80px;
        height: 20px;
        background-color: #a78bfa; /* Warna ungu */
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        z-index: -1; /* Di belakang konten utama */
    }
    .modal-content::after {
        content: '';
        position: absolute;
        bottom: -10px;
        right: 20px;
        transform: rotate(-8deg); /* Sudut bawah sticker */
        width: 60px;
        height: 15px;
        background-color: #facc15; /* Warna kuning */
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        z-index: -1;
    }
</style>
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

            {{-- Penjelasan Rekomendasi Musik --}}
            @isset($explanation)
            <div class="mb-6 bg-blue-50 p-4 rounded-xl border border-blue-200 text-blue-800">
                <h3 class="text-lg font-semibold mb-2">Mengapa Musik Ini Direkomendasikan?</h3>
                <p class="text-sm leading-relaxed">{!! $explanation !!}</p>
            </div>
            @endisset

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
                                            <path d="M256,0C114.625,0,0,114.625,0,256c0,141.374,114.625,256,256,256c141.374,0,256-114.626,256-256 	C512,114.625,397.374,0,256,0z M351.062,258.898l-144,85.945c-1.031,0.626-2.344,0.657-3.406,0.031 	c-1.031-0.594-1.687-1.702-1.687-2.937v-85.946v-85.946c0-1.218,0.656-2.343,1.687-2.938c1.062-0.609,2.375-0.578,3.406,0.031 	l144,85.962c1.031,0.586,1.641,1.718,1.641,2.89C352.703,257.187,352.094,258.297,351.062,258.898z"/>
                                        </g>
                                    </svg>
                                </div>
                            </a>
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
{{-- Modal untuk penjelasan Valence/Energy --}}
<div id="infoModal" class="modal-overlay hidden">
    <div class="modal-content">
        <h3 id="infoModalTitle" class="text-xl font-bold mb-4 text-gray-800"></h3>
        <p id="infoModalBody" class="text-gray-700 leading-relaxed mb-6"></p>
        <div class="flex justify-end">
            <button type="button" onclick="hideInfoModal()"
                    class="px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition duration-200 text-sm font-medium">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk menampilkan modal info
    function showInfoModal(title, body) {
        document.getElementById('infoModalTitle').innerText = title;
        document.getElementById('infoModalBody').innerText = body;
        const modal = document.getElementById('infoModal');
        modal.classList.remove('hidden');
        setTimeout(() => modal.classList.add('show'), 10); // Tambahkan kelas 'show' setelah sedikit delay
    }

    // Fungsi untuk menyembunyikan modal info
    function hideInfoModal() {
        const modal = document.getElementById('infoModal');
        modal.classList.remove('show');
        setTimeout(() => modal.classList.add('hidden'), 300); // Sembunyikan setelah transisi selesai
    }

    document.addEventListener('DOMContentLoaded', function() {
        const infoTerms = document.querySelectorAll('.info-term');
        infoTerms.forEach(term => {
            term.addEventListener('click', function() {
                const termType = this.dataset.term;
                let title = '';
                let body = '';

                if (termType === 'valence') {
                    title = 'Apa itu Valence?';
                    body = 'Valence adalah ukuran seberapa positif atau negatif suatu emosi atau suasana hati. Dalam konteks musik, valence mengacu pada tingkat "kecerahan" atau "kegelapan" sebuah lagu. Lagu dengan valence tinggi (mendekati 1) terdengar ceria, bahagia, dan positif, sedangkan lagu dengan valence rendah (mendekati 0) terdengar sedih, melankolis, atau negatif.';
                } else if (termType === 'energy') {
                    title = 'Apa itu Energy?';
                    body = 'Energy adalah ukuran intensitas atau aktivitas suatu emosi atau suasana hati. Dalam konteks musik, energy mengacu pada tingkat "kekuatan" atau "keaktifan" sebuah lagu. Lagu dengan energy tinggi (mendekati 1) terdengar energik, cepat, dan intens, sedangkan lagu dengan energy rendah (mendekati 0) terdengar tenang, lambat, dan lembut.';
                }

                if (title && body) {
                    showInfoModal(title, body);
                }
            });
        });

        // Opsional: Tutup modal jika mengklik di luar area modal
        const infoModal = document.getElementById('infoModal');
        if (infoModal) {
            infoModal.addEventListener('click', function(event) {
                if (event.target === infoModal) {
                    hideInfoModal();
                }
            });
        }
    });
</script>

@endsection