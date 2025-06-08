@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 bg-white px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto bg-white p-6 sm:p-10 rounded-[3rem] border border-gray-200 shadow-sm text-center transform transition-all duration-500 hover:scale-105 hover:shadow-3xl relative overflow-hidden flex flex-col lg:flex-row items-center lg:justify-center space-y-8 lg:space-y-0 lg:space-x-12">
        {{-- Dekorasi Bintik-bintik (Dot Pattern) --}}
        <div class="absolute inset-0 z-0 opacity-10" style="background-image: radial-gradient(#a0a0a0 1px, transparent 1px); background-size: 20px 20px;"></div>

        {{-- GIF Ilustrasi (Sisi Kiri, kini lebih ke tengah) --}}
        <div class="relative z-10 flex-shrink-0">
            <img src="{{ asset('images/gif/cat-greeting.gif') }}" alt="Cat Greeting"
                 class="w-48 h-48 sm:w-56 sm:h-56 rounded-full object-cover mb-4 animate-bounce-slow transform rotate-3 hover:rotate-0 transition-transform duration-300 ease-in-out sticker-effect">
        </div>

        {{-- Konten Teks (Sisi Kanan) --}}
        <div class="relative z-10 flex flex-col items-center lg:items-start text-center lg:text-left space-y-6 flex-grow">
            {{-- Icon Sukses --}}
            <div class="bg-green-100 text-green-600 rounded-full p-5 sm:p-6 shadow-md border border-green-300 sticker-effect-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 sm:h-12 sm:w-12" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                </svg>
            </div>

            {{-- Judul --}}
            <h2 class="text-4xl sm:text-5xl font-extrabold text-gray-800 tracking-tight leading-tight comic-font">
                Kuesioner Selesai! <span class="wave-emoji text-5xl sm:text-6xl">🥳</span>
            </h2>

            {{-- Pesan --}}
            <p class="text-gray-600 text-lg sm:text-xl leading-relaxed mt-3 cozy-text">
                Terima kasih banyak telah mengisi kuesioner minggu ini. <br class="hidden sm:inline">
                Kami menantikan refleksi suasana hati Anda minggu depan!
            </p>

            {{-- Tombol Kembali --}}
            <a href="{{ route('dashboard') }}"
               class="mt-6 inline-flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white font-bold px-8 py-3 sm:px-10 sm:py-4 rounded-full transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-blue-300 focus:ring-offset-2 text-lg sticker-button">
                <i class="fas fa-home mr-3"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Gochi+Hand&family=Caveat:wght@400;700&display=swap');

    /* Basic animation for the party popper emoji */
    .wave-emoji {
        display: inline-block;
        animation: wave 1.5s infinite alternate;
    }

    @keyframes wave {
        0% { transform: rotate(0deg); }
        25% { transform: rotate(15deg); }
        50% { transform: rotate(0deg); }
        75% { transform: rotate(-15deg); }
        100% { transform: rotate(0deg); }
    }

    /* Slow bounce animation for the GIF */
    @keyframes bounce-slow {
        0%, 100% {
            transform: translateY(0) rotate(3deg); /* Maintain initial rotation */
        }
        50% {
            transform: translateY(-15px) rotate(3deg); /* Slightly move up and maintain rotation */
        }
    }
    .animate-bounce-slow {
        animation: bounce-slow 4s infinite ease-in-out;
    }

    /* Custom shadow for a "sticker" feel */
    .shadow-3xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25), 0 0 0 10px rgba(255, 192, 203, 0.2); /* Light pink ring */
    }

    /* Sticker effect for GIF (moved from inline style, applied to the img tag) */
    .sticker-effect {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15),
                    0 0 0 6px rgba(255, 255, 255, 0.8), /* White border effect */
                    0 0 0 8px rgba(255, 223, 186, 0.5); /* Light orange outline */
    }

    /* Sticker effect for small icon */
    .sticker-effect-sm {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1),
                    0 0 0 4px rgba(255, 255, 255, 0.8), /* White border effect */
                    0 0 0 5px rgba(144, 238, 144, 0.5); /* Light green outline */
        border-radius: 9999px;
    }

    /* Sticker effect for button */
    .sticker-button {
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15),
                    0 0 0 5px rgba(255, 255, 255, 0.8), /* White border effect */
                    0 0 0 7px rgba(173, 216, 230, 0.5); /* Light blue outline */
        border-radius: 9999px; /* Full rounded corners */
        transition: all 0.3s ease;
    }

    .sticker-button:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2),
                    0 0 0 5px rgba(255, 255, 255, 0.8),
                    0 0 0 10px rgba(173, 216, 230, 0.7); /* More prominent hover outline */
        transform: translateY(-2px) scale(1.02);
    }

    /* Custom fonts for cute style */
    .comic-font {
        font-family: 'Gochi Hand', cursive; /* A playful, handwritten style */
        text-shadow: 2px 2px 0px rgba(255, 255, 255, 0.7); /* White outline for "sticker" text */
    }

    .cozy-text {
        font-family: 'Caveat', cursive; /* A relaxed, friendly script */
    }
</style>
@endsection