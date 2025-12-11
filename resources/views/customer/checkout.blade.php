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
                                <div class="product-image-zoom rounded"
                                    style="width: 80px; height: 80px; overflow: hidden; flex-shrink: 0;">
                                    <img src="{{ asset($product->productImages->first()->image ?? 'https://via.placeholder.com/100') }}"
                                        alt="{{ $product->name }}"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold">{{ $product->name }}</h3>
                                    <p class="text-gray-600">{{ $product->store->name }}</p>
                                    <p class="text-gray-600">Qty: {{ $qty }}</p>
                                    <p class="font-bold text-indigo-600">Rp
                                        {{ number_format($product->price * $qty, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Address -->
                        <div class="mb-6">
                            <h3 class="font-semibold mb-4">{{ __('app.shipping_address') }}</h3>
                            <div class="space-y-4">
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-1">{{ __('app.full_address') }}</label>
                                    <textarea name="address" rows="3" required
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700 mb-1">{{ __('app.city') }}</label>
                                        <input type="text" name="city" required
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700 mb-1">{{ __('app.postal_code') }}</label>
                                        <input type="text" name="postal_code" required
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Type -->
                        <div class="mb-6">
                            <h3 class="font-semibold mb-4">{{ __('app.select_shipping') }}</h3>
                            <select name="shipping_type" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="regular">{{ __('app.regular') }} (Rp 15.000)</option>
                                <option value="express">{{ __('app.express') }} (Rp 25.000)</option>
                                <option value="same_day">{{ __('app.same_day') }} (Rp 35.000)</option>
                            </select>
                        </div>

                        <!-- Payment Method -->
                        <div class="mb-6">
                            <h3 class="font-semibold mb-4">{{ __('app.payment_method') }}</h3>
                            <div class="space-y-2">
                                <label class="flex items-center p-4 border rounded cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="payment_method" value="wallet" class="mr-3">
                                    <div class="flex-1">
                                        <span class="font-medium">{{ __('app.wallet_method') }}</span>
                                        <p class="text-sm text-gray-600">{{ __('app.your_balance') }}: Rp
                                            {{ number_format($userBalance->balance ?? 0, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </label>
                                <label class="flex items-center p-4 border rounded cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="payment_method" value="va" checked class="mr-3">
                                    <div class="flex-1">
                                        <span class="font-medium">{{ __('app.va_method') }}</span>
                                        <p class="text-sm text-gray-600">{{ __('app.pay_via_bank') }}</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="mb-6 p-4 bg-gray-50 rounded">
                            <h3 class="font-semibold mb-4">{{ __('app.order_summary') }}</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span>{{ __('app.subtotal') }}</span>
                                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>{{ __('app.shipping_fee') }}</span>
                                    <span>Rp {{ number_format($shippingCost, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>{{ __('app.tax') }} (11%)</span>
                                    <span>Rp {{ number_format($tax, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between font-bold text-lg border-t pt-2">
                                    <span>{{ __('app.total') }}</span>
                                    <span class="text-indigo-600">Rp
                                        {{ number_format($grandTotal, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-indigo-700 transition duration-200 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            💳 {{ __('app.pay_process') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>