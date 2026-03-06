<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>The Sweet Spot - Premium Candy & Chocolate</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-pink-50 min-h-screen flex flex-col relative overflow-x-hidden">
        
        <!-- Background Decorations -->
        <div class="fixed top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-[-20%] left-[20%] w-96 h-96 bg-yellow-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
        </div>

        <nav class="relative z-10 flex justify-between items-center px-8 py-6 max-w-7xl mx-auto w-full">
            <div class="flex items-center space-x-2">
                <div class="bg-gradient-to-br from-pink-500 to-purple-600 text-white p-2 rounded-lg shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />
                    </svg>
                </div>
                <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-pink-600 to-purple-600">The Sweet Spot</span>
            </div>
            
            <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/products') }}" class="font-semibold text-gray-600 hover:text-pink-600 transition">Shop</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-pink-600 transition">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-full font-semibold shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition">Get Started</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>

        <main class="relative z-10 flex-grow flex items-center justify-center px-4">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between w-full h-full">
                
                <div class="md:w-1/2 mb-12 md:mb-0 text-center md:text-left">
                    <span class="inline-block py-1 px-3 rounded-full bg-pink-100 text-pink-600 text-sm font-bold mb-4 animate-pulse">
                        New Arrivals: Gourmet Truffles
                    </span>
                    <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 leading-tight mb-6">
                        Experience the <br> 
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500">Sweetest Moments</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 max-w-lg mx-auto md:mx-0">
                        Handcrafted chocolates, artisan candies, and pure sugary bliss. Indulge your senses in our premium collection.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 justify-center md:justify-start">
                        <a href="{{ route('login') }}" class="px-8 py-4 bg-gradient-to-r from-pink-600 to-purple-600 text-white rounded-full font-bold text-lg shadow-xl hover:shadow-2xl hover:scale-105 transform transition duration-300">
                            Shop Now
                        </a>
                        <a href="#featured" class="px-8 py-4 bg-white text-pink-600 border-2 border-pink-100 rounded-full font-bold text-lg shadow-md hover:border-pink-300 hover:bg-pink-50 transition duration-300">
                            View Collection
                        </a>
                    </div>
                </div>

                <div class="md:w-1/2 flex justify-center relative">
                     <!-- Abstract Candy shapes/images -->
                     <div class="relative w-full max-w-lg aspect-square">
                        <div class="absolute inset-0 bg-gradient-to-tr from-pink-400 to-purple-400 rounded-full opacity-20 blur-3xl animate-pulse"></div>
                        <!-- Using a placeholder SVGs for visuals since I can't generate real images easily to put in welcome without upload -->
                         <div class="relative z-10 grid grid-cols-2 gap-4 p-4 transform rotate-3">
                            <div class="bg-white/80 backdrop-blur-md p-4 rounded-2xl shadow-xl flex items-center justify-center aspect-square transform hover:scale-105 transition duration-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="bg-white/80 backdrop-blur-md p-4 rounded-2xl shadow-xl flex items-center justify-center aspect-square transform translate-y-8 hover:scale-105 transition duration-500">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                                  </svg>
                            </div>
                            <div class="bg-white/80 backdrop-blur-md p-4 rounded-2xl shadow-xl flex items-center justify-center aspect-square transform -translate-y-4 hover:scale-105 transition duration-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                  </svg>
                            </div>
                            <div class="bg-white/80 backdrop-blur-md p-4 rounded-2xl shadow-xl flex items-center justify-center aspect-square transform translate-y-4 hover:scale-105 transition duration-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                  </svg>
                            </div>
                         </div>
                     </div>
                </div>

            </div>
        </main>
        
        <footer class="relative z-10 py-6 text-center text-gray-500 text-sm">
            &copy; 2026 The Sweet Spot. All rights reserved.
        </footer>

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
            .animation-delay-4000 {
                animation-delay: 4s;
            }
        </style>
    </body>
</html>
