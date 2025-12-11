<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                {{ __('app.order_details') }} #{{ $order->id }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Order Info -->
                <div class="md:col-span-2 space-y-6">
                    <!-- Items -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('app.items') }}</h3>
                            <div class="space-y-4">
                                @foreach ($order->transactionDetails as $detail)
                                    <div class="flex gap-4 items-center">
                                        <img src="{{ asset('storage/' . $detail->product->productImages->first()->image_path ?? 'images/no-image.png') }}" 
                                             class="w-16 h-16 object-cover rounded" alt="">
                                        <div class="flex-1">
                                            <h4 class="font-bold text-gray-800">{{ $detail->product->name }}</h4>
                                            <p class="text-sm text-gray-600">{{ $detail->qty }} x Rp {{ number_format($detail->price, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="font-bold text-gray-900">
                                            Rp {{ number_format($detail->qty * $detail->price, 0, ',', '.') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-4 pt-4 border-t flex justify-end">
                                <span class="text-lg font-bold">{{ __('app.total_price') }}: Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Info -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('app.shipping_info') }}</h3>
                            <p><strong>{{ __('app.customer') }}:</strong> {{ $order->user->name }}</p>
                            <p><strong>{{ __('app.shipping_address') }}:</strong> {{ $order->address }}</p>
                            <p><strong>{{ __('app.shipping_type') }}:</strong> {{ $order->shipping_type }}</p>
                            <p><strong>{{ __('app.shipping_cost') }}:</strong> Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="md:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('app.shipping_status') }}</h3>
                            
                            @if(session('success'))
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('seller.orders.update', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">
                                        {{ __('app.tracking_number') }}
                                    </label>
                                    <input type="text" name="tracking_number" value="{{ old('tracking_number', $order->tracking_number) }}"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        placeholder="Input number...">
                                </div>

                                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    {{ __('app.update_tracking') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
