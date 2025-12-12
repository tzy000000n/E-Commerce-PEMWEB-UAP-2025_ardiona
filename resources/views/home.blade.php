<x-app-layout>
    <!-- Opsi 2: Inline CSS -->
    <style>
        .product-card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease, opacity 0.3s ease;
            transform-origin: center;
        }

        .product-card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .product-card-scroll {
            transition: transform 0.5s ease, opacity 0.5s ease;
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

        .search-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2rem;
            border-radius: 1rem;
            margin-bottom: 2rem;
        }

        .search-input-custom {
            border: 2px solid transparent;
            transition: border-color 0.3s;
        }

        .search-input-custom:focus {
            border-color: #667eea;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productCards = document.querySelectorAll('.product-card-hover');

            function handleScroll() {
                const scrollPosition = window.scrollY;
                const windowHeight = window.innerHeight;

                productCards.forEach((card, index) => {
                    const cardTop = card.getBoundingClientRect().top + scrollPosition;
                    const cardBottom = cardTop + card.offsetHeight;

                    // Jika card sudah di-scroll melewati viewport
                    if (scrollPosition > cardBottom - windowHeight * 0.3) {
                        const scrollDistance = scrollPosition - (cardBottom - windowHeight * 0.3);
                        const maxScroll = 300; // Jarak scroll maksimal untuk efek
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
            handleScroll(); // Initial check
        });
    </script>

    <div>
        <!-- Hero/Featured Video Section -->
        <div class="w-full"
            style="min-height: 100vh; overflow: hidden; position: relative; background: #e5e5e5; display: flex; align-items: center; justify-content: center;">
            <video autoplay muted loop playsinline style="max-width: 100%; height: auto; display: block;">
                <source src="{{ asset('videos/hero.mp4') }}" type="video/mp4">
                <!-- Fallback ke image jika video tidak support -->
                <img src="{{ asset('images/hero.jpg') }}" alt="DK Supply Co. Featured"
                    style="max-width: 100%; height: auto;">
            </video>
            <div
                style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(to right, rgba(0,0,0,0.5), rgba(0,0,0,0.1));">
            </div>
            <div style="position: absolute; top: 8%; left: 8%; text-align: left; max-width: 600px;">
                <div style="margin-bottom: 1.5rem;">
                    <h1
                        style="font-size: 5rem; font-weight: 900; margin: 0; letter-spacing: 0.05em; color: #ffffff; text-shadow: 4px 4px 12px rgba(0,0,0,0.9), -2px -2px 6px rgba(0,0,0,0.7); font-family: 'Arial Black', sans-serif; line-height: 0.9;">
                        DK</h1>
                    <p
                        style="font-size: 1.1rem; font-weight: 600; color: #ffffff; margin: 0.5rem 0 0 0; text-shadow: 2px 2px 8px rgba(0,0,0,0.9); letter-spacing: 0.3em; font-family: 'Arial', sans-serif;">
                        SUPPLY CO.</p>
                </div>
                <p
                    style="font-size: 1.3rem; font-weight: 300; color: #f0f0f0; margin-bottom: 1.5rem; text-shadow: 2px 2px 8px rgba(0,0,0,0.9), -1px -1px 4px rgba(0,0,0,0.7);">
                    {{ __('app.premium_streetwear') }}</p>
                <a href="{{ route('shop') }}"
                    style="display: inline-block; padding: 0.9rem 2.2rem; background: white; color: #1a1a1a; font-weight: 600; text-decoration: none; border-radius: 0; transition: all 0.3s; text-transform: uppercase; letter-spacing: 0.1em; font-size: 0.9rem; box-shadow: 0 4px 12px rgba(0,0,0,0.4);">{{ __('app.shop_now') }}</a>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="margin-top: 3rem;">
            <!-- Products Section Title -->
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">{{ __('app.featured_products') }}</h2>
                <p class="text-gray-600 text-lg">{{ __('app.discover_collection') }}</p>
            </div>

            <!-- Products Grid - Baris 1: 4 produk -->
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; margin-bottom: 1.5rem;">
                @foreach($products->take(4) as $product)
                    <!-- Card dengan styling menarik -->
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden product-card-hover"
                        style="border: 2px solid rgba(102, 126, 234, 0.1);">
                        <a href="{{ route('product.show', $product->slug) }}">
                            <div class="product-image-zoom"
                                style="width: 100%; height: 250px; overflow: hidden; background: #f3f4f6;">
                                <img src="{{ asset($product->productImages->first()->image ?? 'https://via.placeholder.com/300x300.png?text=No+Image') }}"
                                    alt="{{ $product->name }}"
                                    style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-lg mb-2 truncate text-gray-800">{{ $product->name }}</h3>
                                <p class="text-sm text-gray-500 mb-3">{{ $product->localized_short_description }}</p>
                                <div class="flex items-center justify-between">
                                    <p class="text-2xl font-bold price-tag">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                                    <div class="mt-3 flex justify-between items-center">
                                        <span class="text-xs text-gray-500">
                                            {{ __('app.stock') }}: {{ $product->stock }}
                                        </span>
                                        <span class="text-xs text-gray-400 font-semibold flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $product->store->name }}
                                        </span>
                                    </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Products Grid - Baris 2: 1 produk -->
            @if($products->count() > 4)
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; margin-bottom: 2rem;">
                    @foreach($products->skip(4)->take(1) as $product)
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden product-card-hover"
                            style="border: 2px solid rgba(102, 126, 234, 0.1);">
                            <a href="{{ route('product.show', $product->slug) }}">
                                <div class="product-image-zoom"
                                    style="width: 100%; height: 250px; overflow: hidden; background: #f3f4f6;">
                                    <img src="{{ asset($product->productImages->first()->image ?? 'https://via.placeholder.com/300x300.png?text=No+Image') }}"
                                        alt="{{ $product->name }}"
                                        style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                                </div>
                                <div class="p-4">
                                    <h3 class="font-bold text-lg mb-2 truncate text-gray-800">{{ $product->name }}</h3>
                                    <p class="text-sm text-gray-500 mb-3">{{ $product->localized_short_description }}</p>
                                    <div class="flex items-center justify-between">
                                        <p class="text-2xl font-bold price-tag">Rp
                                            {{ number_format($product->price, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="mt-3 flex justify-between items-center">
                                        <span class="text-xs text-gray-500">
                                            {{ __('app.stock') }}: {{ $product->stock }}
                                        </span>
                                        <span class="text-xs text-gray-400 font-semibold flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $product->store->name }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Tombol Tampilkan Semua -->
            <div class="text-center mt-8">
                <a href="{{ route('shop') }}"
                    class="inline-block px-8 py-4 bg-purple-600 text-white font-bold text-lg rounded-lg shadow-lg hover:bg-purple-700 hover:shadow-xl hover:scale-105 transition-all duration-300">
                    {{ __('app.show_all_products') }} →
                </a>
            </div>
        </div>
    </div>
</x-app-layout>