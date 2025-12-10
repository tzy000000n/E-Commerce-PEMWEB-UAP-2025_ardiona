<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-bold mb-6">Riwayat Transaksi</h1>

                    @forelse($transactions as $transaction)
                        <div class="mb-4 p-4 border rounded hover:shadow-md transition">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <p class="font-semibold">{{ $transaction->code }}</p>
                                    <p class="text-sm text-gray-600">{{ $transaction->store->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $transaction->created_at->format('d M Y H:i') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-indigo-600">Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</p>
                                    <span class="inline-block px-3 py-1 text-sm rounded-full {{ $transaction->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $transaction->payment_status === 'paid' ? 'Lunas' : 'Belum Bayar' }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                @foreach($transaction->transactionDetails as $detail)
                                    <div class="flex gap-2 text-sm text-gray-600">
                                        <span>{{ $detail->product->name }}</span>
                                        <span>x{{ $detail->qty }}</span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('history.show', $transaction->id) }}" 
                                    class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                    Lihat Detail →
                                </a>
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
