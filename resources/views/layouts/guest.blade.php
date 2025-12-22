<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
            
            <!-- Logo/Brand -->
            <div>
                <a href="/" class="flex items-center">
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                        SIMSE
                    </h1>
                </a>
            </div>

            <!-- Card Container -->
            <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white/70 backdrop-blur-sm shadow-xl overflow-hidden sm:rounded-2xl border border-white/50">
                {{ $slot }}
            </div>

            <!-- Back to Home Link -->
            <div class="mt-6">
                <a href="/" class="text-sm text-gray-600 hover:text-indigo-600 transition">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
    </body>
</html>