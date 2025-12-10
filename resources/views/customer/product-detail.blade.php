<x-app-layout>
    <!-- Demo semua opsi CSS -->
    <div class="py-4 fade-in">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Images -->
                        <div>
                            @if($product->productImages->count() > 0)
                                <div class="product-image-zoom rounded-lg mb-4" style="overflow: hidden; height: 400px;">
                                    <img src="{{ asset($product->productImages->where('is_thumbnail', true)->first()->image ?? $product->productImages->first()->image) }}" 
                                        alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div class="grid grid-cols-4 gap-2">
                                    @foreach($product->productImages as $image)
                                        <div class="product-image-zoom rounded" style="overflow: hidden;">
                                            <img src="{{ asset($image->image) }}" alt="{{ $product->name }}" class="w-full h-20 object-cover">
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="product-image-zoom rounded-lg" style="overflow: hidden; height: 400px;">
                                    <img src="https://via.placeholder.com/500x500.png?text=No+Image" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div>
                            <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                            <p class="text-3xl font-bold text-indigo-600 mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            
                            <div class="mb-4">
                                <p class="text-gray-600"><span class="font-semibold">Kategori:</span> {{ $product->productCategory->name }}</p>
                                <p class="text-gray-600"><span class="font-semibold">Kondisi:</span> {{ ucfirst($product->condition) }}</p>
                                <p class="text-gray-600"><span class="font-semibold">Berat:</span> {{ $product->weight }}g</p>
                                <p class="text-gray-600"><span class="font-semibold">Stok:</span> {{ $product->stock }}</p>
                            </div>

                            <div class="mb-6">
                                <h3 class="font-semibold mb-2">Deskripsi:</h3>
                                <p class="text-gray-700">{{ $product->description }}</p>
                            </div>

                            @auth
                                @if($product->stock > 0)
                                    <form action="{{ route('checkout.index') }}" method="GET" class="flex gap-4">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="number" name="qty" value="1" min="1" max="{{ $product->stock }}" 
                                            class="w-20 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <button type="submit" class="flex-1 px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 font-semibold">
                                            Beli Sekarang
                                        </button>
                                    </form>
                                @else
                                    <p class="text-red-600 font-semibold">Stok Habis</p>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="block text-center px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 font-semibold">
                                    Login untuk Membeli
                                </a>
                            @endauth
                        </div>
                    </div>

                    <!-- Reviews -->
                    @if($product->productReviews->count() > 0)
                        <div class="mt-8 border-t pt-8">
                            <h2 class="text-2xl font-bold mb-4">Review Produk</h2>
                            @foreach($product->productReviews as $review)
                                <div class="mb-4 p-4 bg-gray-50 rounded">
                                    <div class="flex items-center mb-2">
                                        <span class="font-semibold">{{ $review->transaction->user->name }}</span>
                                        <span class="ml-4 text-yellow-500">★ {{ $review->rating }}/5</span>
                                    </div>
                                    <p class="text-gray-700">{{ $review->review }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
