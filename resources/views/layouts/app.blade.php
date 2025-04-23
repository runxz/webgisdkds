<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'WebGIS') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    <!-- Vite assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Extra styles -->
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <div class="min-h-screen flex flex-col">

        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Page Header -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-grow max-w-4xl  py-10 px-6 sm:px-8 lg:px-10">
        <div class=" mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 transition transform hover:-translate-y-0.5 duration-300">
   
        @if (session('success'))
                    <div class="mb-4 p-4 rounded bg-green-100 text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="py-4 text-center text-sm text-gray-500 dark:text-gray-400">
            &copy; {{ date('Y') }} WebGIS Nagari
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
