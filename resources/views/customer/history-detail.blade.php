<x-app-layout>
    <div class="py-4">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-bold mb-6">{{ __('app.transaction_detail') }}</h1>

                    <div class="mb-6">
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <p class="text-sm text-gray-600">{{ __('app.transaction_code') }}</p>
                                <p class="font-semibold">{{ $transaction->code }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">{{ __('app.payment_status') }}</p>
                                <span class="inline-block px-3 py-1 text-sm rounded-full {{ $transaction->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $transaction->payment_status === 'paid' ? __('app.paid') : __('app.unpaid') }}
                                </span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">{{ __('app.date') }}</p>
                                <p class="font-semibold">{{ $transaction->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">{{ __('app.tracking_number') }}</p>
                                <p class="font-semibold">{{ $transaction->tracking_number ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="font-semibold mb-4">{{ __('app.shipping_address') }}</h3>
                        <p class="text-gray-700">{{ $transaction->address }}</p>
                        <p class="text-gray-700">{{ $transaction->city }}, {{ $transaction->postal_code }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="font-semibold mb-4">{{ __('app.products') }}</h3>
                        @foreach($transaction->transactionDetails as $detail)
                            @if($detail->product)
                                <div class="flex gap-4 mb-4 p-4 bg-gray-50 rounded">
                                    <div class="product-image-zoom rounded" style="width: 80px; height: 80px; overflow: hidden; flex-shrink: 0;">
                                        <img src="{{ asset($detail->product->productImages->first()->image ?? 'https://via.placeholder.com/80') }}" 
                                            alt="{{ $detail->product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold">{{ $detail->product->name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $detail->qty }} x Rp {{ number_format($detail->product->price, 0, ',', '.') }}</p>
                                        <p class="font-bold text-indigo-600">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                                        
                                        {{-- Form Review --}}
                                        @if($transaction->payment_status === 'paid')
                                            @php
                                                $hasReviewed = \App\Models\ProductReview::where('transaction_id', $transaction->id)
                                                    ->where('product_id', $detail->product_id)
                                                    ->exists();
                                            @endphp
                                            
                                            @if(!$hasReviewed)
                                                <button onclick="document.getElementById('review-form-{{ $detail->id }}').classList.toggle('hidden')" 
                                                    class="mt-2 text-sm text-indigo-600 hover:text-indigo-800 font-semibold underline">
                                                    {{ __('app.give_review') }}
                                                </button>
                                                
                                                <div id="review-form-{{ $detail->id }}" class="hidden mt-3 p-4 bg-white border rounded-lg shadow-sm">
                                                    <form action="{{ route('reviews.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="transaction_detail_id" value="{{ $detail->id }}">
                                                        <input type="hidden" name="product_id" value="{{ $detail->product_id }}">
                                                        
                                                        <div class="mb-3">
                                                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('app.rating') }}</label>
                                                            <div class="flex gap-4">
                                                                <label class="flex items-center gap-1 cursor-pointer">
                                                                    <input type="radio" name="rating" value="5" class="text-indigo-600 focus:ring-indigo-500" checked>
                                                                    <span class="text-yellow-500">★★★★★</span>
                                                                </label>
                                                                <label class="flex items-center gap-1 cursor-pointer">
                                                                    <input type="radio" name="rating" value="4" class="text-indigo-600 focus:ring-indigo-500">
                                                                    <span class="text-yellow-500">★★★★</span>
                                                                </label>
                                                                <label class="flex items-center gap-1 cursor-pointer">
                                                                    <input type="radio" name="rating" value="3" class="text-indigo-600 focus:ring-indigo-500">
                                                                    <span class="text-yellow-500">★★★</span>
                                                                </label>
                                                                <label class="flex items-center gap-1 cursor-pointer">
                                                                    <input type="radio" name="rating" value="2" class="text-indigo-600 focus:ring-indigo-500">
                                                                    <span class="text-yellow-500">★★</span>
                                                                </label>
                                                                <label class="flex items-center gap-1 cursor-pointer">
                                                                    <input type="radio" name="rating" value="1" class="text-indigo-600 focus:ring-indigo-500">
                                                                    <span class="text-yellow-500">★</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mb-3">
                                                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('app.your_review') }}</label>
                                                            <textarea name="review" rows="3" required minlength="5" placeholder="{{ __('app.write_experience') }}"
                                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                                        </div>
                                                        
                                                        <div class="flex justify-end gap-2">
                                                            <button type="button" onclick="document.getElementById('review-form-{{ $detail->id }}').classList.add('hidden')"
                                                                class="px-3 py-1.5 text-gray-600 hover:text-gray-800 text-sm">
                                                                {{ __('app.cancel') }}
                                                            </button>
                                                            <button type="submit" class="px-4 py-1.5 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm font-semibold">
                                                                {{ __('app.submit_review') }}
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @else
                                                <p class="mt-2 text-sm text-green-600 font-semibold">✓ {{ __('app.review_sent') }}</p>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="flex gap-4 mb-4 p-4 bg-gray-50 rounded">
                                    <div class="rounded bg-gray-200" style="width: 80px; height: 80px; flex-shrink: 0; display: flex; align-items: center; justify-content: center;">
                                        <span class="text-gray-400 text-xs">{{ __('app.item_deleted') }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-500">{{ __('app.product_unavailable') }}</h4>
                                        <p class="text-sm text-gray-600">{{ $detail->qty }} item</p>
                                        <p class="font-bold text-indigo-600">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="p-4 bg-gray-50 rounded">
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span>{{ __('app.subtotal') }}</span>
                                <span>Rp {{ number_format($transaction->transactionDetails->sum('subtotal'), 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>{{ __('app.shipping_fee') }} ({{ $transaction->shipping_type }})</span>
                                <span>Rp {{ number_format($transaction->shipping_cost, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>{{ __('app.tax') }}</span>
                                <span>Rp {{ number_format($transaction->tax, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between font-bold text-lg border-t pt-2">
                                <span>{{ __('app.total') }}</span>
                                <span class="text-indigo-600">Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    @if($transaction->payment_status === 'unpaid')
                        @php
                            $va = \App\Models\VirtualAccount::where('transaction_id', $transaction->id)
                                ->where('status', 'pending')
                                ->first();
                        @endphp
                        
                        @if($va)
                            <div class="mt-6">
                                <a href="{{ route('payment.index', ['va_number' => $va->va_number]) }}" 
                                    class="block w-full text-center px-6 py-3 bg-green-600 text-white rounded-md hover:bg-green-700 font-semibold">
                                    {{ __('app.pay_now') }}
                                </a>
                                
                                <div class="mt-4 p-4 bg-indigo-50 border-2 border-indigo-500 rounded-lg">
                                    <p class="text-sm text-gray-600 mb-2 text-center">{{ __('app.va_code') }}:</p>
                                    <div class="flex items-center justify-center gap-3">
                                        <p id="va-code" class="text-2xl font-bold text-indigo-600 tracking-wider">{{ $va->va_number }}</p>
                                        <button type="button" onclick="copyVACode()" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-sm font-semibold">
                                            {{ __('app.copy') }}
                                        </button>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2 text-center">{{ __('app.copy_va_desc') }}</p>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyVACode() {
            const vaText = document.getElementById('va-code').textContent;
            navigator.clipboard.writeText(vaText).then(() => {
                alert('Kode VA berhasil disalin!');
            }).catch(err => {
                console.error('Gagal menyalin:', err);
            });
        }
    </script>
</x-app-layout>
