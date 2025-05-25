<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', config('app.name', 'Vibely'))</title>

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 font-sans antialiased">

    <!-- Banner (optional) -->
    <x-banner />

    <div class="min-h-screen">
        <!-- Navbar dari Jetstream -->
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if(View::hasSection('header'))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold text-gray-900">
                        @yield('header')
                    </h1>
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="py-10">
            <div class="max-w-4xl mx-auto px-6 lg:px-8 space-y-10">
                @yield('content')
            </div>
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>
</html>
