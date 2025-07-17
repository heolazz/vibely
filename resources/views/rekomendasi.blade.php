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
<div class="bg-cover bg-center min-h-screen py-12" style="background-image: url('{{ asset('images/bg-kuiz.jpg') }}');"> {{-- Perhatikan: bg-kuiz.jpg --}}
    {{-- Kontainer utama: Default px-4, sm:px-6 (tablet), lg:px-8 (desktop) untuk spasi yang lebih baik --}}
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <h1 class="text-3xl mb-4 font-bold text-center text-white drop-shadow-lg">Temukan Musik Untuk Emosimu </h1>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="md:col-span-2 space-y-6">
                <form action="{{ url('/rekomendasi') }}" method="POST" class="bg-white bg-opacity-90 backdrop-blur-md p-6 rounded-lg shadow-md">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Pilih Emosimu Hari Ini:</label>
                        {{-- Menyesuaikan kolom grid untuk penyelarasan yang lebih baik dan lebih banyak emosi --}}
                        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-4 gap-4">
                            @php
                                // Emosi dasar dalam Bahasa Indonesia dengan emoji yang sesuai
                                $emotions = [
                                    ['value' => 'Senang', 'label' => '😄 Senang'],
                                    ['value' => 'Sedih', 'label' => '😢 Sedih'],
                                    ['value' => 'Marah', 'label' => '😠 Marah'],
                                    ['value' => 'Cemas', 'label' => '😟 Cemas'],
                                ];
                            @endphp

                            @foreach ($emotions as $emotionOption)
                                <label class="cursor-pointer">
                                    <input type="radio" name="emotion" value="{{ $emotionOption['value'] }}" class="hidden peer" required>
                                    <div class="p-3 rounded-lg border-2 border-transparent text-center shadow transition-all duration-200
                                                peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:shadow-lg
                                                hover:border-blue-300 hover:bg-blue-100">
                                        <span class="text-3xl">{{ explode(' ', $emotionOption['label'])[0] }}</span>
                                        <div class="text-sm mt-1 text-gray-700 font-medium">{{ implode(' ', array_slice(explode(' ', $emotionOption['label']), 1)) }}</div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="note" class="block text-gray-700 font-semibold mb-2">Catatanmu Hari Ini:</label>

                        <div class="">
                            <div class="bg-white rounded-xl p-3">
                                <textarea
                                    name="note"
                                    id="note"
                                    rows="11"
                                    class="w-full h-full text-black placeholder-gray-400
                                                bg-[url('data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'></svg>')]
                                                bg-repeat-y bg-[length:100%_2.5rem] resize-none focus:outline-none rounded-xl p-2"
                                    placeholder="Tulis sesuatu yang ingin kamu refleksikan hari ini..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-6">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-3 px-8 rounded-full shadow-lg transition duration-200">
                            Simpan Jurnal & Dapatkan Musik
                        </button>
                    </div>
                </form>

                {{-- Bagian Rekomendasi Musik yang Diperbaiki --}}
                @isset($songs)
                <div class="mt-8 bg-white bg-opacity-90 backdrop-blur-md p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">
                        Musik untuk Emosi: <span class="capitalize text-blue-600">{{ $emotion }}</span>
                    </h2>

                    {{-- Penjelasan Rekomendasi Musik --}}
                    @isset($explanation)
                    <div class="mb-6 bg-blue-50 p-4 rounded-xl border border-blue-200 text-blue-800">
                        <h3 class="text-lg font-semibold mb-2">Mengapa Musik Ini Direkomendasikan?</h3>
                        <p class="text-sm leading-relaxed">{!! $explanation !!}</p>
                    </div>
                    @endisset

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
                        <p class="text-gray-500 text-center">Belum ada lagu untuk emosi ini. Coba pilih emosi lain atau tulis catatan lebih detail!</p>
                    @endif
                </div>
                @endisset
            </div>

            {{-- Bagian Histori Emosi (Tetap Tidak Berubah) --}}
            <div class="bg-white bg-opacity-90 backdrop-blur-md p-6 rounded-lg shadow-md max-h-[595px] overflow-y-auto">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Histori Emosimu</h2>

                {{-- Tombol filter untuk riwayat --}}
                <div class="mb-4 flex justify-center space-x-2">
                    <a href="{{ route('rekomendasi', ['days' => 0]) }}"
                       class="px-4 py-2 rounded-full text-sm font-medium {{ ($daysFilter ?? 0) == 0 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        Semua
                    </a>
                    <a href="{{ route('rekomendasi', ['days' => 7]) }}"
                       class="px-4 py-2 rounded-full text-sm font-medium {{ ($daysFilter ?? 0) == 7 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        7 Hari
                    </a>
                    <a href="{{ route('rekomendasi', ['days' => 30]) }}"
                       class="px-4 py-2 rounded-full text-sm font-medium {{ ($daysFilter ?? 0) == 30 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        30 Hari
                    </a>
                </div>
                {{-- AKHIR Tombol filter untuk riwayat --}}

                {{-- Bagian Grafik Emosi --}}
                <div class="mb-2">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Ringkasan Emosi Kamu</h3>
                    @if(collect($emotionCounts ?? [])->sum() > 0) {{-- Hanya tampilkan jika ada data --}}
                        {{-- Container baru untuk canvas Chart.js dengan ukuran eksplisit --}}
                        <div class="relative h-64 w-full"> {{-- Tinggi 64 (256px), lebar 100% --}}
                            <canvas id="emotionChart"></canvas>
                        </div>
                    @else
                        <p class="text-gray-500 text-center text-sm italic">Catat emosimu untuk melihat grafiknya di sini!</p>
                    @endif
                </div>
                {{-- Akhir Bagian Grafik Emosi --}}

                @if(($emotionNotes ?? collect())->count())
                    <ul class="space-y-4">
                        @foreach($emotionNotes as $note)
                            {{-- Buat seluruh kartu riwayat dapat diklik --}}
                            <li class="p-4 bg-white rounded shadow-sm border border-gray-200 flex justify-between items-start cursor-pointer hover:bg-gray-50 transition duration-200">
                                <a href="{{ route('emotion.show', $note->id) }}" class="flex-grow block">
                                    <div>
                                        <div class="text-gray-800 font-semibold text-lg">Emosi: <span class="capitalize text-blue-600">{{ ucfirst($note->emotion) }}</span></div>
                                        @if($note->note)
                                            <div class="text-gray-700 mt-1 text-sm italic">"{{ Str::limit($note->note, 100) }}"</div>
                                        @endif
                                        <div class="text-gray-500 text-xs mt-2">{{ $note->created_at->format('d M Y, H:i') }}</div>
                                    </div>
                                </a>
                                {{-- Tombol hapus dipindahkan ke halaman detail --}}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-600 text-center italic py-4">Belum ada histori emosi. Mulai dengan menyimpan jurnal pertamamu!</p>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Link Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{-- Link Font Awesome untuk ikon eksternal link (dihapus jika tidak dipakai lagi) --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> --}}


<script>
    let emotionChartInstance = null; // Deklarasikan variabel untuk menyimpan instance grafik

    document.addEventListener('DOMContentLoaded', function() {
        const emotionCounts = @json($emotionCounts ?? []); // Ambil data dari Controller

        const labels = Object.keys(emotionCounts);
        const data = Object.values(emotionCounts);

        // Definisikan warna yang konsisten untuk setiap emosi
        const backgroundColors = {
            'Senang': 'rgba(255, 205, 86, 0.8)', // Kuning
            'Sedih': 'rgba(54, 162, 235, 0.8)',  // Biru
            'Marah': 'rgba(255, 99, 132, 0.8)',  // Merah
            'Cemas': 'rgba(75, 192, 192, 0.8)'   // Hijau kebiruan
        };

        const borderColors = {
            'Senang': 'rgba(255, 205, 86, 1)',
            'Sedih': 'rgba(54, 162, 235, 1)',
            'Marah': 'rgba(255, 99, 132, 1)',
            'Cemas': 'rgba(75, 192, 192, 1)'
        };

        // Buat array warna sesuai urutan label
        const chartBackgroundColors = labels.map(label => backgroundColors[label]);
        const chartBorderColors = labels.map(label => borderColors[label]);

        // Cek apakah ada data untuk digambar
        const totalEntries = data.reduce((sum, current) => sum + current, 0);

        if (totalEntries > 0) {
            const ctx = document.getElementById('emotionChart');

            // Hancurkan instance grafik yang ada jika ada untuk mencegah duplikasi atau masalah rendering
            if (emotionChartInstance) {
                emotionChartInstance.destroy();
            }

            emotionChartInstance = new Chart(ctx, { // Tetapkan ke variabel instance
                type: 'doughnut', // Bisa juga 'pie' atau 'bar'
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Catatan',
                        data: data,
                        backgroundColor: chartBackgroundColors,
                        borderColor: chartBorderColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Penting untuk mengontrol ukuran dengan parent container
                    plugins: {
                        legend: {
                            position: 'right', // Letakkan legend di kanan
                            labels: {
                                font: {
                                    size: 14 // Ukuran font legend
                                }
                            }
                        },
                        title: {
                            display: false, // Judul sudah ada di H3
                            text: 'Distribusi Emosi'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += context.parsed;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        } else {
            // Jika tidak ada data, pastikan grafik yang ada dihancurkan
            if (emotionChartInstance) {
                emotionChartInstance.destroy();
                emotionChartInstance = null; // Setel ulang variabel
            }
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