<x-app-layout>
    <div class="py-4">
        <div class="max-w-2xl mx-auto px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-bold mb-6">Top Up Saldo</h1>

                    <div class="mb-6 p-4 bg-indigo-50 rounded">
                        <p class="text-sm text-gray-600">Saldo Saat Ini</p>
                        <p class="text-3xl font-bold text-indigo-600">Rp {{ number_format($userBalance->balance, 0, ',', '.') }}</p>
                    </div>

                    <form action="{{ route('wallet.topup.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Top Up</label>
                            <input type="number" name="amount" min="10000" step="1000" required
                                placeholder="Minimal Rp 10.000"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <p class="text-sm text-gray-500 mt-1">Minimal top up Rp 10.000</p>
                        </div>

                        <button type="submit" class="w-full px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 font-semibold">
                            Buat Virtual Account
                        </button>
                    </form>

                    <div class="mt-6 p-4 bg-gray-50 rounded">
                        <h3 class="font-semibold mb-2">Cara Top Up:</h3>
                        <ol class="list-decimal list-inside space-y-1 text-sm text-gray-700">
                            <li>Masukkan jumlah yang ingin di-top up</li>
                            <li>Sistem akan membuat Virtual Account</li>
                            <li>Transfer sesuai nominal ke VA yang diberikan</li>
                            <li>Saldo otomatis bertambah setelah pembayaran dikonfirmasi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
