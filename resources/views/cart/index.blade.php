<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Sweet Cart 🛒') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-pink-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl rounded-3xl p-8 border border-pink-100">
                
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-xl shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if(count($cart) > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b-2 border-pink-50 text-pink-600 font-bold uppercase text-sm tracking-wider">
                                    <th class="py-4 px-2">Product</th>
                                    <th class="py-4 px-2 text-center">Price</th>
                                    <th class="py-4 px-2 text-center">Quantity</th>
                                    <th class="py-4 px-2 text-right">Subtotal</th>
                                    <th class="py-4 px-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $id => $details)
                                    <tr class="border-b border-pink-50 hover:bg-pink-50/30 transition">
                                        <td class="py-6 px-2">
                                            <div class="flex items-center space-x-4">
                                                <div class="w-16 h-16 bg-pink-100 rounded-xl overflow-hidden flex-shrink-0">
                                                    @if($details['image'])
                                                        <img src="{{ asset('storage/' . $details['image']) }}" class="w-full h-full object-cover">
                                                    @else
                                                        <div class="flex items-center justify-center h-full text-pink-300">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                                <span class="font-bold text-gray-800 text-lg">{{ $details['name'] }}</span>
                                            </div>
                                        </td>
                                        <td class="py-6 px-2 text-center text-gray-600 font-medium">Rs {{ number_format($details['price'], 2) }}</td>
                                        <td class="py-6 px-2 text-center">
                                            <span class="bg-gray-100 px-4 py-2 rounded-lg font-bold text-gray-800">{{ $details['quantity'] }}</span>
                                        </td>
                                        <td class="py-6 px-2 text-right font-black text-pink-600 text-lg">
                                            Rs {{ number_format($details['price'] * $details['quantity'], 2) }}
                                        </td>
                                        <td class="py-6 px-2 text-center">
                                            <form action="{{ route('cart.remove') }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $id }}">
                                                <button type="submit" class="text-red-400 hover:text-red-600 transition p-2 hover:bg-red-50 rounded-xl">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-12 flex flex-col md:flex-row justify-between items-center gap-8 bg-pink-50 p-8 rounded-3xl">
                        <div>
                            <p class="text-gray-500 font-medium mb-1 uppercase tracking-widest text-sm">Grand Total</p>
                            <h3 class="text-5xl font-black text-pink-600">Rs {{ number_format($total, 2) }}</h3>
                        </div>
                        <div class="flex gap-4 w-full md:w-auto">
                            <a href="{{ route('shop.index') }}" class="flex-1 md:flex-none text-center bg-white text-gray-700 font-bold py-4 px-8 rounded-2xl hover:bg-gray-100 transition shadow-sm border border-pink-100">
                                Continue Shopping
                            </a>
                            <a href="{{ route('orders.checkout') }}" class="flex-1 md:flex-none text-center bg-gradient-to-r from-pink-500 to-purple-600 text-white font-bold py-4 px-12 rounded-2xl hover:shadow-xl transform hover:-translate-y-1 transition duration-300">
                                Proceed to Checkout
                            </a>
                        </div>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-20 text-center">
                        <div class="bg-pink-100 p-8 rounded-full mb-8 text-pink-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-3xl font-black text-gray-800 mb-4">Your cart is empty!</h3>
                        <p class="text-gray-500 mb-8 max-w-sm">It looks like you haven't added any sweet treats to your cart yet. Let's find something delicious!</p>
                        <a href="{{ route('shop.index') }}" class="bg-gradient-to-r from-pink-500 to-purple-600 text-white font-bold py-4 px-10 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                            Browse Our Sweets
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
