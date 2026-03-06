<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sweet Shop - Browse Our Collection') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-pink-50 via-purple-50 to-yellow-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-pink-600 to-purple-600 rounded-2xl shadow-2xl p-8 mb-8 text-white">
                <h1 class="text-4xl font-bold mb-2">🍬 Welcome to The Sweet Spot!</h1>
                <p class="text-pink-100 text-lg">Discover our premium collection of handcrafted candies and chocolates</p>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($products as $product)
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-2 overflow-hidden group">
                        <div class="h-56 w-full bg-gradient-to-br from-pink-100 to-purple-100 relative overflow-hidden">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @else
                                <div class="flex items-center justify-center h-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-pink-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @endif
                            
                            <!-- Category Badge -->
                            <div class="absolute top-3 right-3">
                                <span class="bg-white/90 backdrop-blur-sm text-{{ $product->category === 'Chocolate' ? 'purple' : ($product->category === 'Candy' ? 'pink' : 'yellow') }}-600 text-xs font-bold px-3 py-1 rounded-full shadow-md">
                                    {{ $product->category }}
                                </span>
                            </div>
                            
                            <!-- Stock Badge -->
                            @if($product->stock < 20)
                                <div class="absolute top-3 left-3">
                                    <span class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md animate-pulse">
                                        Low Stock!
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-5">
                            <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-1">{{ $product->name }}</h3>
                            <p class="text-gray-500 text-sm mb-4 line-clamp-2 h-10">{{ $product->description ?? 'Delicious sweet treat!' }}</p>
                            
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-2">
                                    <span class="text-3xl font-bold text-pink-600">Rs {{ number_format($product->price, 2) }}</span>
                                </div>
                                <div class="flex items-center space-x-1 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-gray-600 font-medium">{{ $product->stock }} in stock</span>
                                </div>
                            </div>
                            
                            <div class="flex gap-2">
                                <a href="{{ route('shop.show', $product->id) }}" class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-3 px-4 rounded-xl transition duration-300">
                                    Details
                                </a>
                                @if($product->stock > 0)
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full text-center bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 text-white font-bold py-3 px-4 rounded-xl shadow-md transform transition duration-300 hover:scale-105">
                                            Add to Cart
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="flex-1 text-center bg-gray-300 text-white font-bold py-3 px-4 rounded-xl cursor-not-allowed">
                                        Sold Out
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-20">
                        <div class="bg-pink-100 p-6 rounded-full mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-700 mb-2">No Products Available</h3>
                        <p class="text-gray-500">Check back soon for new sweet treats!</p>
                    </div>
                @endforelse
            </div>
            
        </div>
    </div>
</x-app-layout>
