<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Products Section with Pagination -->
                    <h2 class="text-2xl font-semibold mb-6">{{ __("Products") }}</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($products as $product)
                            <div class="border rounded-lg shadow-md overflow-hidden">
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-48 object-cover" loading="lazy">
                                <div class="p-4">
                                    <p class="text-sm text-gray-500 mb-1">{{ $product->category->name ?? 'Uncategorized' }}</p>

                                    <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                                    <p class="text-gray-700 mt-2">${{ number_format($product->price, 2) }}</p>
                                    <button class="mt-4 w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600 transition">
                                        Buy Now
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination Links -->
                    <div class="mt-6">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
