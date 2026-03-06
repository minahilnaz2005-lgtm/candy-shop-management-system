<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Sweet') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-pink-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl border border-pink-100">
                
                <div class="bg-gradient-to-r from-pink-500 to-purple-500 p-6">
                    <h3 class="text-2xl font-bold text-white">Edit Treat</h3>
                    <p class="text-pink-100 text-sm mt-1">Update the details for {{ $product->name }}.</p>
                </div>

                <div class="p-8">
                    @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                            <p class="font-bold">Whoops! Something went wrong.</p>
                            <ul class="list-disc ml-5 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-1 md:col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                                <input type="text" name="name" id="name" value="{{ $product->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50" required>
                            </div>

                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                                <select name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50">
                                    <option value="Candy" {{ $product->category == 'Candy' ? 'selected' : '' }}>Candy</option>
                                    <option value="Chocolate" {{ $product->category == 'Chocolate' ? 'selected' : '' }}>Chocolate</option>
                                    <option value="Toffee" {{ $product->category == 'Toffee' ? 'selected' : '' }}>Toffee</option>
                                    <option value="Gummy" {{ $product->category == 'Gummy' ? 'selected' : '' }}>Gummy</option>
                                    <option value="Cookie" {{ $product->category == 'Cookie' ? 'selected' : '' }}>Cookie</option>
                                    <option value="Other" {{ $product->category == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Price (Rs)</label>
                                <input type="number" step="0.01" name="price" id="price" value="{{ $product->price }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50" required>
                            </div>

                            <div>
                                <label for="stock" class="block text-sm font-medium text-gray-700">Stock Quantity</label>
                                <input type="number" name="stock" id="stock" value="{{ $product->stock }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50" required>
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50">{{ $product->description }}</textarea>
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <label for="image" class="block text-sm font-medium text-gray-700">Product Image</label>
                                @if($product->image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" class="h-20 w-20 object-cover rounded shadow">
                                    </div>
                                @endif
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-pink-500 transition-colors">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-pink-600 hover:text-pink-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-pink-500">
                                                <span>Upload a new file</span>
                                                <input id="image" name="image" type="file" class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('products.index') }}" class="mr-4 text-gray-500 hover:text-gray-700 font-medium">Cancel</a>
                            <button type="submit" class="bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 text-white font-bold py-2 px-6 rounded-full shadow-md transform transition duration-300 hover:scale-105">
                                Update Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
