@extends('layouts.app')

@section('content')
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

                @isset($songs)
                <div class="mt-8 bg-white bg-opacity-90 backdrop-blur-md p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">
                        Musik untuk Emosi: <span class="capitalize text-blue-600">{{ $emotion }}</span>
                    </h2>
                    @if($songs->count())
                        <ul class="space-y-3">
                            @foreach($songs as $song)
                                <li class="p-4 bg-blue-50 rounded-lg shadow-sm border border-blue-200 flex items-center space-x-3">
                                    <span class="text-blue-500 text-xl">🎵</span>
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-800">{{ $song->title }}</h3>
                                        <p class="text-gray-600 text-sm">{{ $song->artist }}</p>
                                        {{-- Tampilkan link musik --}}
                                        @if($song->link)
                                            <a href="{{ $song->link }}" target="_blank" class="text-blue-600 hover:underline text-sm font-medium block mt-1">Dengarkan di sini <i class="fas fa-external-link-alt text-xs ml-1"></i></a>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 text-center">Belum ada lagu untuk emosi ini. Coba pilih emosi lain atau tulis catatan lebih detail!</p>
                    @endif
                </div>
                @endisset
            </div>

            <div class="bg-white bg-opacity-90 backdrop-blur-md p-6 rounded-lg shadow-md max-h-[595px] overflow-y-auto">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Histori Emosimu</h2>

                {{-- Tombol filter untuk riwayat --}}
                <div class="mb-4 flex justify-center space-x-2">
                    <a href="{{ route('rekomendasi', ['days' => 0]) }}"
                       class="px-4 py-2 rounded-full text-sm font-medium {{ $daysFilter == 0 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        Semua
                    </a>
                    <a href="{{ route('rekomendasi', ['days' => 7]) }}"
                       class="px-4 py-2 rounded-full text-sm font-medium {{ $daysFilter == 7 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        7 Hari
                    </a>
                    <a href="{{ route('rekomendasi', ['days' => 30]) }}"
                       class="px-4 py-2 rounded-full text-sm font-medium {{ $daysFilter == 30 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        30 Hari
                    </a>
                </div>
                {{-- AKHIR Tombol filter untuk riwayat --}}

                {{-- Bagian Grafik Emosi --}}
                <div class="mb-2">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Ringkasan Emosi Kamu</h3>
                    @if(collect($emotionCounts)->sum() > 0) {{-- Hanya tampilkan jika ada data --}}
                        {{-- Container baru untuk canvas Chart.js dengan ukuran eksplisit --}}
                        <div class="relative h-64 w-full"> {{-- Tinggi 64 (256px), lebar 100% --}}
                            <canvas id="emotionChart"></canvas>
                        </div>
                    @else
                        <p class="text-gray-500 text-center text-sm italic">Catat emosimu untuk melihat grafiknya di sini!</p>
                    @endif
                </div>
                {{-- Akhir Bagian Grafik Emosi --}}

                @if($emotionNotes->count())
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
{{-- Link Font Awesome untuk ikon eksternal link --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


<script>
    let emotionChartInstance = null; // Deklarasikan variabel untuk menyimpan instance grafik

    document.addEventListener('DOMContentLoaded', function() {
        const emotionCounts = @json($emotionCounts); // Ambil data dari Controller

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
@endsection
