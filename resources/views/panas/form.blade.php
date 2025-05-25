@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-cover bg-no-repeat bg-center pt-4" style="background-image: url('/images/bg-kuiz.jpg');">
        <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700&display=swap" rel="stylesheet">
<style>
  body {
    font-family: 'Fredoka', sans-serif;
  }
</style>

<div class="max-w-3xl mx-auto py-6 px-6 bg-white bg-opacity-90 backdrop-blur-md rounded-[2.5rem] shadow-xl border-4 border-white">
    
    <!-- Header & Maskot -->
    <div class="text-center mb-6">
        <img src="/images/gif/cat-greeting.gif" class="mx-auto w-28 h-28  drop-shadow-[0_4px_10px_rgba(96,165,250,0.4)]" alt="Maskot">
        <h1 class="text-4xl font-extrabold text-[#3b82f6] drop-shadow-sm">💙 Kuesioner PANAS Mingguan</h1>
        <p class="text-[#3b82f6] text-base mt-2">Refleksikan emosimu selama 7 hari terakhir 💭</p>
    </div>

    <!-- Cara Pengisian -->
    <div class="mb-6">
        <div class="flex items-center space-x-2 cursor-pointer select-none" id="toggleInstructionsBtn" title="Lihat cara pengisian">
            <h3 class="text-[#3b82f6] font-semibold text-lg">Cara Pengisian</h3>
            <span class="text-blue-300 text-xl font-bold">💡</span>
        </div>
    </div>

    <!-- Progress Bar -->
    <div class="w-full bg-blue-100 rounded-full h-4 mb-6 border-2 border-white overflow-hidden">
        <div id="progress-bar" class="bg-blue-400 h-4 rounded-full transition-all duration-500 ease-in-out" style="width: 0%"></div>
    </div>

    <!-- Form -->
    <form action="{{ route('panas.store') }}" method="POST" id="panasForm">
        @csrf

        @foreach ($questions as $index => $question)
        <div class="question-step transition-opacity duration-300 {{ $index === 0 ? '' : 'hidden' }}" data-step="{{ $index }}">
            <div class="bg-white border-4 border-blue-200 rounded-[2rem] p-6 shadow-lg drop-shadow-[0_4px_10px_rgba(147,197,253,0.4)]">
                <div class="flex items-center mb-4">
                    <!-- <span class="text-2xl mr-2">🧠</span> -->
                    <h2 class="text-[#3b82f6] text-lg font-semibold">{{ $index + 1 }}. {{ $question->question_text }}</h2>
                </div>

                <div class="flex flex-wrap justify-center gap-4 mt-4">
                    @for ($i = 1; $i <= 5; $i++)
                    <label class="flex items-center space-x-2 cursor-pointer bg-blue-100 px-4 py-2 rounded-2xl shadow hover:bg-blue-200 transition border-2 border-white">
                        <input 
                            type="radio" 
                            name="responses[{{ $question->id }}]" 
                            value="{{ $i }}" 
                            class="w-5 h-5 text-blue-500 focus:ring-blue-300"
                            required
                        >
                        <span class="text-[#3b82f6] text-lg font-medium">{{ $i }}</span>
                    </label>
                    @endfor
                </div>
            </div>

            <!-- Navigasi -->
            <div class="flex justify-between mt-6">
                @if ($index > 0)
                <button type="button" class="prev-step bg-blue-70 hover:bg-blue-300 text-[#3b82f6] hover:text-white font-bold py-2 px-5 rounded-2xl shadow">
                    Kembali
                </button>
                @endif

                @if ($index < count($questions) - 1)
                <button type="button" class="next-step bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 px-6 rounded-2xl shadow ml-auto">
                    Lanjut
                </button>
                @else
                <button type="submit" class="ml-auto bg-green-400 hover:bg-green-500 text-white font-bold py-2 px-6 rounded-2xl shadow">
                    Selesai 🎉
                </button>
                @endif
            </div>
        </div>
        @endforeach
    </form>
</div>

<!-- Modal Overlay -->
<div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-3xl p-6 max-w-md mx-4 shadow-xl border-4 border-blue-200">
        <h2 class="text-2xl font-bold text-[#3b82f6] mb-4">📘 Cara Mengisi</h2>
        <p class="text-[#3b82f6] mb-4">Pilih angka yang sesuai dengan seberapa sering kamu merasakan hal tersebut selama <strong>7 hari terakhir</strong>.</p>
        <ul class="list-disc list-inside mb-6 text-[#3b82f6]">
            <li>1 = Tidak Pernah</li>
            <li>2 = Jarang</li>
            <li>3 = Kadang-Kadang</li>
            <li>4 = Sering</li>
            <li>5 = Sangat Sering</li>
        </ul>
        <button id="closeModalBtn" class="bg-blue-400 hover:bg-blue-500 text-white font-semibold py-2 px-6 rounded-xl shadow block mx-auto">Mengerti</button>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
    const steps = document.querySelectorAll('.question-step');
    const progressBar = document.getElementById('progress-bar');
    let currentStep = 0;

    function updateProgressBar() {
        const progress = ((currentStep + 1) / steps.length) * 100;
        progressBar.style.width = progress + "%";
    }

    function showStep(index) {
        steps.forEach((step, i) => {
            step.classList.toggle('hidden', i !== index);
            step.classList.toggle('opacity-0', i !== index);
        });
        updateProgressBar();
    }

    document.querySelectorAll('.next-step').forEach(button => {
        button.addEventListener('click', () => {
            const currentInputs = steps[currentStep].querySelectorAll('input[type="radio"]');
            const isChecked = Array.from(currentInputs).some(input => input.checked);

            if (!isChecked) {
                alert("⚠️ Pilih jawaban dulu ya sebelum lanjut.");
                return;
            }

            currentStep++;
            showStep(currentStep);
        });
    });

    document.querySelectorAll('.prev-step').forEach(button => {
        button.addEventListener('click', () => {
            currentStep--;
            showStep(currentStep);
        });
    });

    updateProgressBar();

    // Modal variables & functions
    const modal = document.getElementById('modalOverlay');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const toggleBtn = document.getElementById('toggleInstructionsBtn');

    function showModal() {
        modal.classList.remove('hidden');
    }

    function closeModal() {
        modal.classList.add('hidden');
        sessionStorage.setItem('modalShown', 'true');
    }

    // Show modal only once per session
    if (!sessionStorage.getItem('modalShown')) {
        showModal();
    }

    closeModalBtn.addEventListener('click', closeModal);

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });

    toggleBtn.addEventListener('click', () => {
        showModal();
    });
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const steps = document.querySelectorAll('.question-step');
    const progressBar = document.getElementById('progress-bar');
    let currentStep = 0;

    function updateProgressBar() {
        const progress = ((currentStep + 1) / steps.length) * 100;
        progressBar.style.width = progress + "%";
    }

    function showStep(index) {
        steps.forEach((step, i) => {
            step.classList.toggle('hidden', i !== index);
            step.classList.toggle('opacity-0', i !== index);
        });
        updateProgressBar();
    }

    function canGoNext() {
        const currentInputs = steps[currentStep].querySelectorAll('input[type="radio"]');
        return Array.from(currentInputs).some(input => input.checked);
    }

    function goNext() {
        if (!canGoNext()) {
            alert("⚠️ Pilih jawaban dulu ya sebelum lanjut.");
            return;
        }
        if (currentStep < steps.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
    }

    document.querySelectorAll('.next-step').forEach(button => {
        button.addEventListener('click', goNext);
    });

    document.querySelectorAll('.prev-step').forEach(button => {
        button.addEventListener('click', () => {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        });
    });

    // Tangani tekan tombol space untuk lanjut
    document.addEventListener('keydown', (event) => {
        if (event.code === 'Space') {
            // Cegah scroll halaman saat tekan space di form
            event.preventDefault();
            // Jika bukan step terakhir, lanjutkan
            if (currentStep < steps.length - 1) {
                goNext();
            }
        }
    });

    updateProgressBar();

    // Modal handling tetap sama...
    const modal = document.getElementById('modalOverlay');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const toggleBtn = document.getElementById('toggleInstructionsBtn');

    function showModal() {
        modal.classList.remove('hidden');
    }

    function closeModal() {
        modal.classList.add('hidden');
        sessionStorage.setItem('modalShown', 'true');
    }

    if (!sessionStorage.getItem('modalShown')) {
        showModal();
    }

    closeModalBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });

    toggleBtn.addEventListener('click', showModal);
});

</script>

@endsection
