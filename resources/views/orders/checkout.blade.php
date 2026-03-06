<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Finalize Your Order ✨') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-pink-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Checkout Form -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white p-8 rounded-3xl shadow-xl border border-pink-100">
                        <h3 class="text-2xl font-black text-gray-800 mb-8 flex items-center">
                            <span class="bg-pink-100 text-pink-600 p-2 rounded-xl mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                            Shipping Information
                        </h3>

                        <form action="{{ route('orders.store') }}" method="POST" id="checkout-form" class="space-y-6">
                            @csrf
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="col-span-1 md:col-span-2">
                                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Full Name</label>
                                    <input type="text" name="customer_name" value="{{ Auth::user()->name }}" class="w-full border-2 border-pink-50 rounded-2xl p-4 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition duration-300 shadow-sm" required>
                                </div>

                                <div class="col-span-1 md:col-span-2">
                                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Email Address</label>
                                    <input type="email" name="customer_email" value="{{ Auth::user()->email }}" class="w-full border-2 border-pink-50 rounded-2xl p-4 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition duration-300 shadow-sm" required>
                                </div>

                                <div class="col-span-1 md:col-span-2">
                                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Shipping Address</label>
                                    <textarea name="shipping_address" rows="4" class="w-full border-2 border-pink-50 rounded-2xl p-4 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition duration-300 shadow-sm" placeholder="Enter your full street address, city, state, and zip code..." required></textarea>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="bg-white p-8 rounded-3xl shadow-xl border border-pink-100">
                        <h3 class="text-2xl font-black text-gray-800 mb-8 flex items-center">
                            <span class="bg-purple-100 text-purple-600 p-2 rounded-xl mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </span>
                            Payment Method
                        </h3>
                        <div class="p-6 border-2 border-pink-500 bg-pink-50 rounded-2xl flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="bg-white p-2 rounded-lg shadow-sm mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800">Cash on Delivery</h4>
                                    <p class="text-gray-500 text-sm">Pay when you receive your sweets</p>
                                </div>
                            </div>
                            <div class="text-pink-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white p-8 rounded-3xl shadow-xl border border-pink-100 sticky top-8">
                        <h3 class="text-xl font-black text-gray-800 mb-6 uppercase tracking-widest text-center">Order Summary</h3>
                        
                        <div class="space-y-4 mb-8">
                            @foreach($cart as $id => $details)
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 max-w-[150px] truncate"><span class="font-black text-pink-500">{{ $details['quantity'] }}x</span> {{ $details['name'] }}</span>
                                    <span class="font-bold text-gray-800">Rs {{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t-2 border-pink-50 pt-6 space-y-3 mb-8">
                            <div class="flex justify-between text-gray-500">
                                <span>Subtotal</span>
                                <span>Rs {{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-500">
                                <span>Shipping</span>
                                <span class="text-green-600 font-bold uppercase text-xs pt-1">Free</span>
                            </div>
                            <div class="flex justify-between items-center pt-4 border-t border-pink-50">
                                <span class="text-lg font-black text-gray-800 uppercase">Total</span>
                                <span class="text-3xl font-black text-pink-600">Rs {{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <button type="submit" form="checkout-form" class="w-full bg-gradient-to-r from-pink-500 to-purple-600 text-white font-black py-5 rounded-2xl shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition duration-300 text-lg uppercase tracking-widest">
                            Confirm Order
                        </button>
                        
                        <p class="mt-4 text-[10px] text-gray-400 text-center uppercase leading-tight tracking-widest">
                            By clicking "Confirm Order" you agree to our <br> Terms & Conditions
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
