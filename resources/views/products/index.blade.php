<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Candy Inventory') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-pink-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 border-t-4 border-pink-500">
                
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Your Sweet Collection</h3>
                        <p class="text-gray-500 text-sm italic">Managing total of {{ $totalProducts }} delicious items</p>
                    </div>
                    <a href="{{ route('products.create') }}" class="bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 text-white font-bold py-3 px-6 rounded-2xl shadow-lg transform transition duration-300 hover:scale-105 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add New Treat
                    </a>
                </div>

                <!-- Stock Management Summary Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                    <a href="{{ route('products.index') }}" class="p-6 rounded-2xl border-2 {{ !request('filter') ? 'border-pink-500 bg-pink-50' : 'border-gray-100 bg-white hover:border-pink-200' }} transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Inventory</p>
                                <p class="text-2xl font-black text-gray-800">{{ $totalProducts }}</p>
                            </div>
                            <div class="h-12 w-12 rounded-xl bg-pink-100 flex items-center justify-center text-pink-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('products.index', ['filter' => 'low_stock']) }}" class="p-6 rounded-2xl border-2 {{ request('filter') == 'low_stock' ? 'border-yellow-500 bg-yellow-50' : 'border-gray-100 bg-white hover:border-yellow-200' }} transition relative">
                        @if($lowStockCount > 0)
                        <span class="absolute -top-2 -right-2 flex h-6 w-6">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-6 w-6 bg-yellow-500 text-white text-[10px] items-center justify-center font-bold">{{ $lowStockCount }}</span>
                        </span>
                        @endif
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Low Stock Alert</p>
                                <p class="text-2xl font-black text-gray-800">{{ $lowStockCount }}</p>
                            </div>
                            <div class="h-12 w-12 rounded-xl bg-yellow-100 flex items-center justify-center text-yellow-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                        </div>
                    </a>

                    <div class="p-6 rounded-2xl border-2 border-gray-100 bg-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Out of Stock</p>
                                <p class="text-2xl font-black text-red-600">{{ $outOfStockCount }}</p>
                            </div>
                            <div class="h-12 w-12 rounded-xl bg-red-100 flex items-center justify-center text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sales Report Section (New) -->
                <div class="mb-12">
                    <h3 class="text-xl font-black text-gray-800 mb-6 flex items-center">
                        <span class="bg-indigo-100 text-indigo-600 p-2 rounded-xl mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </span>
                        Sales & Revenue Report
                    </h3>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Revenue Stats -->
                        <div class="lg:col-span-1 bg-gradient-to-br from-indigo-600 to-purple-700 rounded-3xl p-8 text-white shadow-xl transform hover:scale-[1.02] transition duration-300">
                            <p class="text-indigo-100 font-bold uppercase tracking-widest text-xs mb-2">Total Revenue</p>
                            <h4 class="text-5xl font-black mb-6">Rs {{ number_format($totalRevenue, 2) }}</h4>
                            <div class="flex items-center justify-between border-t border-white/20 pt-6">
                                <div>
                                    <p class="text-indigo-100 text-xs uppercase tracking-wider font-bold">Total Orders</p>
                                    <p class="text-2xl font-black">{{ $totalOrders }}</p>
                                </div>
                                <div class="bg-white/20 p-3 rounded-2xl backdrop-blur-sm tracking-tighter">
                                    <span class="text-xs font-bold font-mono">LIVE FEED</span>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Orders Table -->
                        <div class="lg:col-span-2 bg-gray-50 rounded-3xl p-6 border border-gray-100 shadow-inner">
                            <h4 class="text-sm font-black text-gray-400 uppercase tracking-widest mb-4">Recent Sales Activity</h4>
                            <div class="overflow-hidden">
                                <table class="w-full text-left">
                                    <thead>
                                        <tr class="text-[10px] font-black text-gray-400 uppercase tracking-tighter border-b border-gray-200">
                                            <th class="pb-3">Order</th>
                                            <th class="pb-3">Customer</th>
                                            <th class="pb-3">Date</th>
                                            <th class="pb-3 text-right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @forelse($recentSales as $sale)
                                        <tr class="text-sm">
                                            <td class="py-3 font-bold text-indigo-600">#{{ $sale->id }}</td>
                                            <td class="py-3 text-gray-700 font-medium">{{ $sale->customer_name }}</td>
                                            <td class="py-3 text-gray-500">{{ $sale->created_at->format('M d') }}</td>
                                            <td class="py-3 text-right font-black text-gray-800">Rs {{ number_format($sale->total_amount, 2) }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="py-8 text-center text-gray-400 italic">No sales recorded yet.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-t-2 border-pink-50 pt-12">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-xl font-bold text-gray-800">Treat Inventory Details</h3>
                    </div>

                @if(session('success'))
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-xl relative mb-8 shadow-sm flex items-center" role="alert">
                        <div class="bg-green-500 text-white rounded-full p-1 mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline ml-1">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 overflow-hidden group">
                            <div class="h-48 w-full bg-gray-100 relative overflow-hidden">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @else
                                    <div class="flex items-center justify-center h-full text-gray-300 bg-pink-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-2 right-2 bg-white/90 backdrop-blur-sm text-pink-600 text-xs font-bold px-2 py-1 rounded shadow">
                                    {{ $product->category }}
                                </div>
                                @if($product->stock < 10)
                                <div class="absolute top-2 left-2 bg-red-500 text-white text-[10px] font-black px-2 py-1 rounded shadow-lg uppercase tracking-tighter animate-pulse">
                                    Low Stock
                                </div>
                                @elseif($product->stock == 0)
                                <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-[2px] flex items-center justify-center">
                                    <span class="text-white font-black text-xl uppercase tracking-widest border-2 border-white px-4 py-2 rotate-12">Sold Out</span>
                                </div>
                                @endif
                            </div>
                            <div class="p-5">
                                <div class="flex justify-between items-start">
                                    <h4 class="text-lg font-bold text-gray-800 truncate">{{ $product->name }}</h4>
                                    <span class="text-pink-600 font-bold bg-pink-50 px-2 py-1 rounded-lg text-sm">Rs {{ $product->price }}</span>
                                </div>
                                <p class="mt-2 text-gray-500 text-sm h-10 overflow-hidden line-clamp-2">{{ $product->description }}</p>
                                
                                <div class="mt-4 pt-4 border-t border-gray-100 flex flex-col gap-3">
                                    <div class="flex items-center justify-between">
                                        <div class="text-xs font-bold uppercase tracking-wide {{ $product->stock < 10 ? 'text-red-500' : 'text-gray-400' }}">
                                            Stock Level
                                        </div>
                                        <div class="text-sm font-black {{ $product->stock < 10 ? 'text-red-600' : 'text-green-600' }}">
                                            {{ $product->stock }} items
                                        </div>
                                    </div>
                                    
                                    <div class="w-full bg-gray-100 rounded-full h-1.5 overflow-hidden">
                                        <div class="h-full {{ $product->stock < 10 ? 'bg-red-500' : ($product->stock < 30 ? 'bg-yellow-400' : 'bg-green-500') }}" style="width: {{ min($product->stock, 100) }}%"></div>
                                    </div>
                                    
                                    <div class="flex items-center justify-between mt-1">
                                        <div class="flex space-x-3">
                                            <a href="{{ route('products.edit', $product->id) }}" class="p-2 rounded-lg bg-gray-50 text-gray-400 hover:text-blue-500 hover:bg-blue-50 transition shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this treat?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 rounded-lg bg-gray-50 text-gray-400 hover:text-red-500 hover:bg-red-50 transition shadow-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                        <a href="{{ route('products.edit', $product->id) }}" class="text-[10px] font-bold text-blue-600 uppercase hover:underline">Edit Stock</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($products->isEmpty())
                <div class="flex flex-col items-center justify-center py-16">
                    <div class="bg-pink-100 p-4 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <p class="text-gray-500 text-lg">No candy in the shop yet.</p>
                    <a href="{{ route('products.create') }}" class="mt-2 text-pink-600 font-semibold hover:underline">Add your first treat!</a>
                </div>
                @endif
                
            </div>
        </div>
    </div>
</x-app-layout>
