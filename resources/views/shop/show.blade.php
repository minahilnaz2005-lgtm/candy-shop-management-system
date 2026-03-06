<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12 bg-pink-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl">
                
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <!-- Product Image -->
                    <div class="h-96 bg-gradient-to-br from-pink-100 to-purple-100 flex items-center justify-center p-8">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain rounded-lg shadow-xl">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 text-pink-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @endif
                    </div>
                    
                    <!-- Product Details -->
                    <div class="p-8">
                        <div class="mb-4">
                            <span class="bg-gradient-to-r from-pink-500 to-purple-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                                {{ $product->category }}
                            </span>
                        </div>
                        
                        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>
                        
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ $product->description ?? 'A delicious sweet treat that will satisfy your cravings!' }}
                        </p>
                        
                        <div class="border-t border-b border-gray-200 py-4 mb-6">
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-gray-600 font-medium">Price:</span>
                                <span class="text-4xl font-bold text-pink-600">Rs {{ number_format($product->price, 2) }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 font-medium">Availability:</span>
                                @if($product->stock > 20)
                                    <span class="text-green-600 font-bold flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        In Stock ({{ $product->stock }})
                                    </span>
                                @elseif($product->stock > 0)
                                    <span class="text-yellow-600 font-bold flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        Limited Stock ({{ $product->stock }})
                                    </span>
                                @else
                                    <span class="text-red-600 font-bold">Out of Stock</span>
                                @endif
                            </div>
                        </div>
                        
                        <a href="{{ route('shop.index') }}" class="block w-full text-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-4 rounded-xl transition duration-300">
                            ← Back to Shop
                        </a>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
</x-app-layout>
