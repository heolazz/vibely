@extends('layouts.app')

@section('content')
<div class="bg-cover bg-center min-h-screen py-12" style="background-image: url('{{ asset('images/bg-jurnal.png') }}');">
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-center text-white mb-8 drop-shadow-lg">Temukan Musik Untuk Emosimu </h1>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Kiri: Form Pilih Emosi + Catatan -->
            <div class="md:col-span-2 space-y-6">
                <form action="{{ url('/rekomendasi') }}" method="POST" class="bg-white bg-opacity-90 backdrop-blur-md p-6 rounded-lg shadow-md">
                    @csrf

                    <!-- Pilih Emosi -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Putar dan Pilih Emosimu:</label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            @php
                                $emotions = [
                                    ['value' => 'senang', 'label' => '😊 Senang'],
                                    ['value' => 'sedih', 'label' => '😢 Sedih'],
                                    ['value' => 'marah', 'label' => '😡 Marah'],
                                    ['value' => 'takut', 'label' => '😱 Takut'],
                                ];
                            @endphp

                            @foreach ($emotions as $emotionOption)
                                <label class="cursor-pointer">
                                    <input type="radio" name="emotion" value="{{ $emotionOption['value'] }}" class="hidden peer" required>
                                    <div class="p-4 rounded-lg border text-center shadow peer-checked:border-blue-600 peer-checked:bg-blue-50 transition">
                                        <span class="text-2xl">{{ explode(' ', $emotionOption['label'])[0] }}</span>
                                        <div class="text-sm mt-1">{{ explode(' ', $emotionOption['label'])[1] }}</div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

<!-- Catatan -->
<div class="mb-4">
    <label for="note" class="block text-gray-700 font-semibold mb-2">Catatanmu Hari Ini:</label>

    <div class="bg-[#b6a78e] rounded-2xl p-4 shadow-md">
        <div class="bg-white rounded-xl p-3">
            <textarea
                name="note"
                id="note"
                rows="10"
                class="w-full h-full text-black placeholder-gray-400 bg-[url('data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'100%\' height=\'100%\'><line x1=\'0\' y1=\'32\' x2=\'100%\' y2=\'32\' stroke=\'#d1d5db\' stroke-width=\'1\'/><line x1=\'0\' y1=\'64\' x2=\'100%\' y2=\'64\' stroke=\'#d1d5db\' stroke-width=\'1\'/><line x1=\'0\' y1=\'96\' x2=\'100%\' y2=\'96\' stroke=\'#d1d5db\' stroke-width=\'1\'/><line x1=\'0\' y1=\'128\' x2=\'100%\' y2=\'128\' stroke=\'#d1d5db\' stroke-width=\'1\'/><line x1=\'0\' y1=\'160\' x2=\'100%\' y2=\'160\' stroke=\'#d1d5db\' stroke-width=\'1\'/><line x1=\'0\' y1=\'192\' x2=\'100%\' y2=\'192\' stroke=\'#d1d5db\' stroke-width=\'1\'/></svg>')]
                       bg-repeat-y bg-[length:100%_2.5rem] resize-none focus:outline-none rounded-xl p-2"
                placeholder="Tulis sesuatu..."></textarea>
        </div>
    </div>
</div>

                    <!-- Submit -->
<div class="text-center">
    <button type="submit"
        class="bg-[#b6a78e] hover:bg-[#a3947c] text-white font-semibold py-2 px-6 rounded-2xl shadow-md transition duration-200">
        Simpan Jurnal
    </button>
</div>

                </form>

                <!-- Rekomendasi Lagu -->
                @isset($songs)
                <div class="mt-8 bg-white bg-opacity-90 backdrop-blur-md p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-semibold text-brown-500 mb-4 text-center">
                        Musik untuk Emosi: <span class="capitalize">{{ $emotion }}</span>
                    </h2>
                    @if($songs->count())
                        <ul class="space-y-3">
                            @foreach($songs as $song)
                                <li class="p-4 bg-gray-100 rounded-lg shadow-sm">
                                    <h3 class="text-lg font-bold">{{ $song->title }}</h3>
                                    <p class="text-gray-600">{{ $song->artist }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 text-center">Belum ada lagu untuk emosi ini.</p>
                    @endif
                </div>
                @endisset
            </div>

            <!-- Kanan: Histori Emosi -->
            <div class="bg-white bg-opacity-90 backdrop-blur-md p-6 rounded-lg shadow-md max-h-[595px] overflow-y-auto">

                <h2 class="text-xl font-semibold mb-4">Histori Emosimu</h2>
                @if($emotionNotes->count())
                    <ul class="space-y-4">
                        @foreach($emotionNotes as $note)
                            <li class="p-4 bg-gray-100 rounded shadow flex justify-between items-start">
                                <div>
                                    <div class="text-gray-800 font-semibold">Emosi: {{ ucfirst($note->emotion) }}</div>
                                    @if($note->note)
                                        <div class="text-gray-600 mt-1">Catatan: {{ $note->note }}</div>
                                    @endif
                                    <div class="text-gray-400 text-sm mt-1">{{ $note->created_at->format('d M Y, H:i') }}</div>
                                </div>
                                <div class="relative z-10">
                                    <button class="text-gray-600 hover:text-gray-800 focus:outline-none" onclick="toggleDeleteButton({{ $note->id }})">
                                        <span class="text-2xl">...</span>
                                    </button>
                                    <form id="delete-form-{{ $note->id }}" action="{{ route('emotion.destroy', $note->id) }}" method="POST"
                                        class="hidden absolute right-0 mt-2 z-20 bg-white border border-gray-300 rounded shadow-lg">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="block w-full px-4 py-2 text-sm text-red-600 hover:bg-red-100 text-left">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-600">Belum ada histori emosi.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function toggleDeleteButton(noteId) {
        const deleteButton = document.getElementById('delete-form-' + noteId);
        deleteButton.classList.toggle('hidden');
    }
</script>
@endsection
