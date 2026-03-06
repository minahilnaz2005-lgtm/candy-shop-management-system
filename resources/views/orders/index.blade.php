<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Sweet History 🍬') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-pink-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl rounded-3xl p-8 border border-pink-100">
                
                @if($orders->count() > 0)
                    <div class="space-y-6">
                        @foreach($orders as $order)
                            <div class="group bg-white border-2 border-pink-50 rounded-3xl overflow-hidden hover:border-pink-200 transition duration-300">
                                <div class="p-6 sm:px-10 flex flex-col sm:flex-row items-center justify-between gap-6">
                                    <div class="flex items-center gap-6">
                                        <div class="bg-pink-100 p-4 rounded-2xl text-pink-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-xl font-black text-gray-800">Order #{{ $order->id }}</h4>
                                            <p class="text-gray-500 text-sm font-medium">{{ $order->created_at->format('M d, Y') }} at {{ $order->created_at->format('h:i A') }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="text-center sm:text-right">
                                        <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Total Paid</p>
                                        <p class="text-3xl font-black text-pink-600">${{ number_format($order->total_amount, 2) }}</p>
                                    </div>

                                    <div>
                                        <a href="{{ route('orders.show', $order->id) }}" class="inline-flex items-center px-6 py-3 bg-gray-50 text-gray-700 font-bold rounded-xl border border-gray-100 hover:bg-pink-50 hover:text-pink-600 hover:border-pink-200 transition group">
                                            View Details
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="bg-pink-50/30 px-10 py-4 flex items-center justify-between border-t border-pink-50">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                                        <span class="text-[10px] font-black uppercase tracking-widest text-green-600">Status: {{ ucfirst($order->status) }}</span>
                                    </div>
                                    <div class="flex -space-x-3 overflow-hidden">
                                        @foreach($order->items->take(3) as $item)
                                            <div class="inline-block h-8 w-8 rounded-full ring-2 ring-white bg-pink-100 overflow-hidden">
                                                @if($item->product->image)
                                                    <img src="{{ asset('storage/' . $item->product->image) }}" class="h-full w-full object-cover">
                                                @else
                                                    <div class="flex items-center justify-center h-full text-[10px] text-pink-400">{{ substr($item->product->name, 0, 1) }}</div>
                                                @endif
                                            </div>
                                        @endforeach
                                        @if($order->items->count() > 3)
                                            <div class="flex items-center justify-center h-8 w-8 rounded-full ring-2 ring-white bg-gray-100 text-[10px] font-bold text-gray-500">+{{ $order->items->count() - 3 }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-20 text-center">
                        <div class="bg-gray-50 p-8 rounded-full mb-8 text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 012 2v29" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <h3 class="text-3xl font-black text-gray-800 mb-4">No orders yet!</h3>
                        <p class="text-gray-500 mb-8 max-w-sm">You haven't made any purchases yet. Your future delicious orders will appear right here!</p>
                        <a href="{{ route('shop.index') }}" class="bg-gradient-to-r from-pink-500 to-purple-600 text-white font-bold py-4 px-10 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 text-lg">
                            Go Shopping
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
