<x-app-layout>
    <div class="py-4">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-bold mb-6">Checkout</h1>

                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="qty" value="{{ $qty }}">

                        <!-- Product Summary -->
                        <div class="mb-6 p-4 bg-gray-50 rounded">
                            <div class="flex gap-4">
                                <div class="product-image-zoom rounded" style="width: 80px; height: 80px; overflow: hidden; flex-shrink: 0;">
                                    <img src="{{ asset($product->productImages->first()->image ?? 'https://via.placeholder.com/100') }}" 
                                        alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold">{{ $product->name }}</h3>
                                    <p class="text-gray-600">{{ $product->store->name }}</p>
                                    <p class="text-gray-600">Qty: {{ $qty }}</p>
                                    <p class="font-bold text-indigo-600">Rp {{ number_format($product->price * $qty, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Address -->
                        <div class="mb-6">
                            <h3 class="font-semibold mb-4">Alamat Pengiriman</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                                    <textarea name="address" rows="3" required
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                                        <input type="text" name="city" required
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                                        <input type="text" name="postal_code" required
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Type -->
                        <div class="mb-6">
                            <h3 class="font-semibold mb-4">Jenis Pengiriman</h3>
                            <select name="shipping_type" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="regular">Regular (Rp 15.000)</option>
                                <option value="express">Express (Rp 25.000)</option>
                                <option value="same_day">Same Day (Rp 35.000)</option>
                            </select>
                        </div>

                        <!-- Payment Method -->
                        <div class="mb-6">
                            <h3 class="font-semibold mb-4">Metode Pembayaran</h3>
                            <div class="space-y-2">
                                <label class="flex items-center p-4 border rounded cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="payment_method" value="wallet" class="mr-3">
                                    <div class="flex-1">
                                        <span class="font-medium">Saldo Wallet</span>
                                        <p class="text-sm text-gray-600">Saldo Anda: Rp {{ number_format($userBalance->balance ?? 0, 0, ',', '.') }}</p>
                                    </div>
                                </label>
                                <label class="flex items-center p-4 border rounded cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="payment_method" value="va" checked class="mr-3">
                                    <div class="flex-1">
                                        <span class="font-medium">Virtual Account</span>
                                        <p class="text-sm text-gray-600">Bayar via transfer bank</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="mb-6 p-4 bg-gray-50 rounded">
                            <h3 class="font-semibold mb-4">Ringkasan Pesanan</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span>Subtotal</span>
                                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Ongkir</span>
                                    <span>Rp {{ number_format($shippingCost, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Pajak (11%)</span>
                                    <span>Rp {{ number_format($tax, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between font-bold text-lg border-t pt-2">
                                    <span>Total</span>
                                    <span class="text-indigo-600">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn-ripple w-full">
                            💳 Proses Pembayaran
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
