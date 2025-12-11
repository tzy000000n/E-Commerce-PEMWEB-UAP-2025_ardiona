<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-bold mb-6">Riwayat Transaksi</h1>

                    @forelse($transactions as $transaction)
                        <!-- Card Container -->
                        <div onclick="window.location='{{ route('history.show', $transaction->id) }}'"
                            class="mb-4 p-4 border rounded hover:shadow-md transition cursor-pointer bg-white group relative">

                            <!-- Header Info -->
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <p class="font-semibold text-indigo-900 group-hover:text-indigo-700 transition-colors">
                                        {{ $transaction->code }}
                                    </p>
                                    <p class="text-sm text-gray-600">{{ $transaction->store->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $transaction->created_at->format('d M Y H:i') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-indigo-600">Rp
                                        {{ number_format($transaction->grand_total, 0, ',', '.') }}
                                    </p>
                                    <span
                                        class="inline-block px-3 py-1 text-sm rounded-full mt-1 {{ $transaction->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $transaction->payment_status === 'paid' ? 'Lunas' : 'Belum Bayar' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Product List & Reviews -->
                            <div class="mt-4 border-t pt-3">
                                @foreach($transaction->transactionDetails as $detail)
                                    <div class="mb-3 last:mb-0">
                                        <div class="flex gap-3 text-sm text-gray-700">
                                            <span class="font-medium">{{ $detail->product->name }}</span>
                                            <span class="text-gray-500">x{{ $detail->qty }}</span>
                                        </div>

                                        <!-- Review Section -->
                                        @if($transaction->payment_status === 'paid' && $detail->product)
                                            @php
                                                $hasReviewed = \App\Models\ProductReview::where('transaction_id', $transaction->id)
                                                    ->where('product_id', $detail->product_id)
                                                    ->exists();
                                            @endphp

                                            <div class="mt-1 ml-1" onclick="event.stopPropagation()">
                                                @if(!$hasReviewed)
                                                    <button type="button"
                                                        onclick="document.getElementById('review-form-{{ $detail->id }}').classList.toggle('hidden')"
                                                        class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 hover:underline">
                                                        ✎ Beri Ulasan
                                                    </button>

                                                    <!-- Inline Review Form -->
                                                    <div id="review-form-{{ $detail->id }}"
                                                        class="hidden mt-2 p-3 bg-gray-50 border rounded-lg shadow-inner z-20 relative"
                                                        x-data="{ rating: 5, hoverRating: 0 }">
                                                        <form action="{{ route('reviews.store') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="transaction_detail_id" value="{{ $detail->id }}">
                                                            <input type="hidden" name="product_id" value="{{ $detail->product_id }}">
                                                            <input type="hidden" name="rating" x-model="rating">

                                                            <div class="mb-2">
                                                                <label
                                                                    class="block text-xs font-medium text-gray-600 mb-1">Rating</label>
                                                                <div class="flex gap-1">
                                                                    @foreach(range(1, 5) as $star)
                                                                        <button type="button" @click="rating = {{ $star }}"
                                                                            @mouseenter="hoverRating = {{ $star }}"
                                                                            @mouseleave="hoverRating = 0"
                                                                            class="text-xl leading-none focus:outline-none transition-transform transition-colors duration-200 hover:scale-110"
                                                                            :class="(hoverRating ? {{ $star }} <= hoverRating : {{ $star }} <= rating) ? 'text-yellow-400' : 'text-gray-300'">
                                                                            ★
                                                                        </button>
                                                                    @endforeach
                                                                </div>
                                                                <p class="text-xs text-gray-400 mt-1">
                                                                    <span x-text="rating"></span> dari 5 Bintang
                                                                </p>
                                                            </div>

                                                            <div class="mb-2">
                                                                <textarea name="review" rows="2" required minlength="5"
                                                                    placeholder="Tulis pengalaman Anda..."
                                                                    class="w-full text-xs rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                                            </div>

                                                            <div class="flex justify-end gap-2">
                                                                <button type="button"
                                                                    onclick="document.getElementById('review-form-{{ $detail->id }}').classList.add('hidden')"
                                                                    class="px-2 py-1 text-xs text-gray-600 hover:bg-gray-200 rounded">
                                                                    Batal
                                                                </button>
                                                                <button type="submit"
                                                                    class="px-2 py-1 text-xs bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                                                    Kirim
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                @else
                                                    <span class="text-xs text-green-600 font-medium">✓ Ulasan Terkirim</span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-8">Belum ada transaksi</p>
                    @endforelse

                    <div class="mt-6">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>