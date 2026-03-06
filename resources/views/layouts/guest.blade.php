<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Candy Shop') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-pink-50 min-h-screen flex items-center justify-center relative overflow-hidden">
        
        <!-- Background Decorations -->
        <div class="fixed top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        </div>

        <div class="relative z-10 w-full flex flex-col items-center pt-6 sm:pt-0">
            <div class="mb-6 transform hover:scale-110 transition duration-500">
                <a href="/">
                    <div class="bg-gradient-to-br from-pink-500 to-purple-600 text-white p-4 rounded-2xl shadow-xl">
                        <x-application-logo class="w-12 h-12 fill-current" />
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-8 bg-white/80 backdrop-blur-md shadow-2xl overflow-hidden sm:rounded-3xl border border-white/50">
                {{ $slot }}
            </div>
        </div>

        <style>
            @keyframes blob {
                0% { transform: translate(0px, 0px) scale(1); }
                33% { transform: translate(30px, -50px) scale(1.1); }
                66% { transform: translate(-20px, 20px) scale(0.9); }
                100% { transform: translate(0px, 0px) scale(1); }
            }
            .animate-blob {
                animation: blob 7s infinite;
            }
            .animation-delay-2000 {
                animation-delay: 2s;
            }
        </style>
    </body>
</html>
