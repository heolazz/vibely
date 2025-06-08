<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Vibely') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body class="font-sans antialiased text-gray-800 bg-gray-50" x-data="{ sidebarOpen: false }">
<div class="flex min-h-screen">
    <div class="md:hidden" x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 bg-black bg-opacity-50"></div>
    <aside x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300 transform -translate-x-full" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200 transform translate-x-0" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
           class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-md p-6 md:hidden"
           @click.away="sidebarOpen = false">
        <div class="font-bold text-2xl text-black mb-10 flex items-center gap-2">
            <span>🧠</span> <span>Vibely Admin</span>
        </div>

        <nav class="space-y-4 text-gray-700 text-base">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md transition
               {{ Request::routeIs('admin.dashboard') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:text-blue-600' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 9.75L12 3l9 6.75V21a.75.75 0 01-.75.75H3.75A.75.75 0 013 21V9.75z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 22V12h6v10" />
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md transition
               {{ Request::routeIs('admin.users.*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:text-blue-600' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zM4 20c0-2.21 3.58-4 8-4s8 1.79 8 4v1H4v-1z" />
                </svg>
                <span>Manajemen User</span>
            </a>

            <a href="{{ route('admin.songs.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md transition
               {{ Request::routeIs('admin.songs.*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:text-blue-600' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 19V6l12-2v13" />
                    <circle cx="6" cy="18" r="3" stroke="currentColor" stroke-width="2" />
                    <circle cx="18" cy="16" r="3" stroke="currentColor" stroke-width="2" />
                </svg>
                <span>Kelola Musik</span>
            </a>

            <a href="{{ route('admin.articles.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md transition
               {{ Request::routeIs('admin.articles.*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:text-blue-600' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 21H5a2 2 0 01-2-2V7a2 2 0 012-2h4l2-2h6a2 2 0 012 2v14a2 2 0 01-2 2z" />
                </svg>
                <span>Konten Edukasi</span>
            </a>
            <div class="mt-12 bg-indigo-50 p-4 rounded-xl text-center">
                <div class="text-2xl mb-2">💡</div>
                <p class="text-sm font-medium text-indigo-800">
                    {{-- Pastikan randomTip dikirim dari controller jika ingin ditampilkan di sini --}}
                    {{ $randomTip ?? 'Tips harian Anda akan muncul di sini!' }}
                </p>
            </div>
            <img src="{{ asset('images/gif/cat-greeting.gif') }}" alt="Cat Greeting" class="mx-auto mt-4 w-24 h-auto" />
        </nav>
    </aside>

    <aside class="w-64 bg-white shadow-md p-6 hidden md:block fixed inset-y-0 left-0 z-40">
        <div class="font-bold text-2xl text-black mb-10 flex items-center gap-2">
            <span>🧠</span> <span>Vibely Admin</span>
        </div>

        <nav class="space-y-4 text-gray-700 text-base">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md transition
               {{ Request::routeIs('admin.dashboard') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:text-blue-600' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 9.75L12 3l9 6.75V21a.75.75 0 01-.75.75H3.75A.75.75 0 013 21V9.75z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 22V12h6v10" />
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md transition
               {{ Request::routeIs('admin.users.*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:text-blue-600' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zM4 20c0-2.21 3.58-4 8-4s8 1.79 8 4v1H4v-1z" />
                </svg>
                <span>Manajemen User</span>
            </a>

            <a href="{{ route('admin.songs.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md transition
               {{ Request::routeIs('admin.songs.*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:text-blue-600' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 19V6l12-2v13" />
                    <circle cx="6" cy="18" r="3" stroke="currentColor" stroke-width="2" />
                    <circle cx="18" cy="16" r="3" stroke="currentColor" stroke-width="2" />
                </svg>
                <span>Kelola Musik</span>
            </a>

            <a href="{{ route('admin.articles.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md transition
               {{ Request::routeIs('admin.articles.*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:text-blue-600' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 21H5a2 2 0 01-2-2V7a2 2 0 012-2h4l2-2h6a2 2 0 012 2v14a2 2 0 01-2 2z" />
                </svg>
                <span>Konten Edukasi</span>
            </a>
            <div class="mt-12 bg-indigo-50 p-4 rounded-xl text-center">
                <div class="text-2xl mb-2">💡</div>
                <p class="text-sm font-medium text-indigo-800">
                    {{-- Pastikan randomTip dikirim dari controller jika ingin ditampilkan di sini --}}
                    {{ $randomTip ?? 'Tips harian Anda akan muncul di sini!' }}
                </p>
            </div>
            <img src="{{ asset('images/gif/cat-greeting.gif') }}" alt="Cat Greeting" class="mx-auto mt-4 w-24 h-auto" />
        </nav>
    </aside>

    {{-- Tambahkan ml-64 (margin-left: 16rem) pada md breakpoint dan lebih besar --}}
    <div class="flex-1 flex flex-col md:ml-64">
        <header class="bg-white shadow px-4 py-3 flex items-center justify-between md:justify-end">
            <button class="md:hidden text-gray-600 hover:text-blue-700 focus:outline-none" @click="sidebarOpen = !sidebarOpen">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <div class="relative">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition space-x-3 px-3 py-1 hover:bg-gray-100">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            <div class="hidden sm:flex flex-col text-left">
                                <span class="font-semibold text-gray-900 leading-tight">{{ Auth::user()->name }}</span>
                                <span class="text-xs text-gray-500 uppercase tracking-widest">{{ Auth::user()->role ?? 'User' }}</span>
                            </div>
                            <svg class="ms-2 w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}"
                                             onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </header>

        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</div>


@stack('modals')
@livewireScripts
</body>
</html>
@yield('scripts')