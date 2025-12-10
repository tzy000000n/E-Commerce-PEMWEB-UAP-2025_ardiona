<x-app-layout>
    <style>
        .product-card-hover {
            transition: transform 0.5s ease, opacity 0.5s ease, box-shadow 0.3s ease;
            transform-origin: center;
        }
        .product-card-hover:hover {
            transform: translateY(-5px) !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        .product-image-zoom {
            overflow: hidden;
        }
        .product-image-zoom img {
            transition: transform 0.5s ease;
        }
        .product-image-zoom:hover img {
            transform: scale(1.15);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productCards = document.querySelectorAll('.product-card-hover');
            
            function handleScroll() {
                const scrollPosition = window.scrollY;
                const windowHeight = window.innerHeight;
                
                productCards.forEach((card) => {
                    const cardTop = card.getBoundingClientRect().top + scrollPosition;
                    const cardBottom = cardTop + card.offsetHeight;
                    
                    // Jika card sudah di-scroll melewati viewport
                    if (scrollPosition > cardBottom - windowHeight * 0.3) {
                        const scrollDistance = scrollPosition - (cardBottom - windowHeight * 0.3);
                        const maxScroll = 300;
                        const scale = Math.max(0.7, 1 - (scrollDistance / maxScroll) * 0.3);
                        const opacity = Math.max(0.5, 1 - (scrollDistance / maxScroll) * 0.5);
                        
                        card.style.transform = `scale(${scale})`;
                        card.style.opacity = opacity;
                    } else {
                        card.style.transform = 'scale(1)';
                        card.style.opacity = '1';
                    }
                });
            }
            
            window.addEventListener('scroll', handleScroll);
            handleScroll();
        });
    </script>

    <div class="py-4">
        <div class="max-w-full mx-auto">
            <div class="flex gap-0">
                <!-- Sidebar Kiri - Menempel ke kiri -->
                <div class="w-64 flex-shrink-0">
                    <div class="bg-white shadow-lg p-6 sticky top-16" style="min-height: 100vh;">
                        <h3 class="text-xl font-bold mb-4 text-gray-800">{{ __('app.filter_products') }}</h3>
                        
                        <!-- Search -->
                        <form method="GET" action="{{ route('shop') }}">
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('app.search_product') }}</label>
                                <input type="text" name="search" placeholder="{{ __('app.product_name') }}" 
                                    value="{{ request('search') }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                            </div>

                            <!-- Kategori -->
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-3">{{ __('app.category') }}</label>
                                <div class="space-y-2">
                                    <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded">
                                        <input type="radio" name="category" value="" {{ !request('category') ? 'checked' : '' }} 
                                            onchange="this.form.submit()"
                                            class="text-purple-600 focus:ring-purple-500">
                                        <span class="ml-2 text-sm text-gray-700">{{ __('app.all_products') }}</span>
                                    </label>
                                    @foreach($categories as $category)
                                        <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded">
                                            <input type="radio" name="category" value="{{ $category->id }}" 
                                                {{ request('category') == $category->id ? 'checked' : '' }}
                                                onchange="this.form.submit()"
                                                class="text-purple-600 focus:ring-purple-500">
                                            <span class="ml-2 text-sm text-gray-700">{{ $category->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <button type="submit" class="w-full btn-ripple">
                                🔍 {{ __('app.search') }}
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Content Kanan -->
                <div class="flex-1">
                    <!-- Header -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-800">{{ __('app.all_products') }}</h1>
                                <p class="text-gray-600 mt-1">{{ __('app.showing_products', ['count' => $products->total()]) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">
                        @forelse($products as $product)
                            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden product-card-hover" style="border: 2px solid rgba(102, 126, 234, 0.1);">
                                <a href="{{ route('product.show', $product->slug) }}">
                                    <div class="product-image-zoom" style="width: 100%; height: 250px; overflow: hidden; background: #f3f4f6;">
                                        <img src="{{ asset($product->productImages->first()->image ?? 'https://via.placeholder.com/300x300.png?text=No+Image') }}" 
                                            alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-bold text-lg mb-2 truncate text-gray-800">{{ $product->name }}</h3>
                                        <p class="text-sm text-gray-500 mb-3">{{ $product->short_description }}</p>
                                        <div class="flex items-center justify-between">
                                            <p class="text-2xl font-bold price-tag">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="mt-3">
                                            <span class="text-xs text-gray-500">
                                                {{ __('app.stock') }}: {{ $product->stock }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-span-3 text-center py-12 bg-white rounded-2xl">
                                <p class="text-gray-500 text-lg">{{ __('app.no_products') }}</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
