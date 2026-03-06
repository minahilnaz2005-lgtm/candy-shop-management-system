<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Confirmed! 🎉') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-pink-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl rounded-3xl border border-pink-100 relative">
                
                <!-- Success Confetti Background -->
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-pink-500 via-purple-500 to-yellow-500"></div>
                
                <div class="p-12 text-center border-b border-pink-50">
                    <div class="inline-flex items-center justify-center p-4 bg-green-100 text-green-600 rounded-full mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h1 class="text-4xl font-black text-gray-800 mb-2">Thank you, {{ $order->customer_name }}!</h1>
                    <p class="text-gray-500 text-lg">Your order <span class="text-pink-600 font-bold">#{{ $order->id }}</span> has been placed successfully.</p>
                </div>

                <div class="p-12 grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div>
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Shipping Details</h3>
                        <div class="bg-pink-50/50 p-6 rounded-2xl border border-pink-50">
                            <p class="font-bold text-gray-800 mb-1">{{ $order->customer_name }}</p>
                            <p class="text-gray-600 text-sm mb-4">{{ $order->customer_email }}</p>
                            <p class="text-gray-700 leading-relaxed italic">"{{ $order->shipping_address }}"</p>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Order Summary</h3>
                        <div class="space-y-3">
                            @foreach($order->items as $item)
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-600"><span class="font-bold text-pink-600">{{ $item->quantity }}x</span> {{ $item->product->name }}</span>
                                    <span class="font-bold text-gray-800">Rs {{ number_format($item->price * $item->quantity, 2) }}</span>
                                </div>
                            @endforeach
                            <div class="border-t-2 border-pink-50 pt-4 flex justify-between items-center">
                                <span class="text-lg font-black text-gray-800">Total Paid</span>
                                <span class="text-3xl font-black text-pink-600">Rs {{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-gray-500 text-sm">A confirmation email will be sent to your inbox shortly.</p>
                    <div class="flex gap-4">
                        <a href="{{ route('shop.index') }}" class="px-8 py-3 bg-white text-gray-700 font-bold rounded-xl border border-gray-200 hover:bg-gray-100 transition shadow-sm">
                            Return to Shop
                        </a>
                        <a href="{{ route('orders.index') }}" class="px-8 py-3 bg-pink-600 text-white font-bold rounded-xl hover:bg-pink-700 transition shadow-md">
                            View My Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
