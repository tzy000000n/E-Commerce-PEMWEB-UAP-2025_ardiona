<x-app-layout>
    <div class="py-4">
        <div class="max-w-2xl mx-auto px-6">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl" style="border: 3px solid rgba(102, 126, 234, 0.3);">
                <div class="p-6">
                    <h1 class="text-2xl font-bold mb-6">Pembayaran Virtual Account</h1>

                    @if(session('success'))
                        <div class="mb-6 p-6 bg-green-50 border-2 border-green-500 rounded-lg">
                            <p class="text-green-700 mb-4">{{ session('success') }}</p>
                            
                            @if(session('va_number'))
                                <div class="bg-white p-4 rounded-lg border-2 border-indigo-500">
                                    <p class="text-sm text-gray-600 mb-2">Kode Virtual Account Anda:</p>
                                    <div class="flex items-center gap-3">
                                        <p id="va-display" class="text-3xl font-bold text-indigo-600 tracking-wider">{{ session('va_number') }}</p>
                                        <button type="button" onclick="copyVA()" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-sm font-semibold">
                                            Salin
                                        </button>
                                    </div>
                                    @if(session('va_amount'))
                                        <p class="text-sm text-gray-600 mt-3">Jumlah: <strong class="text-lg text-gray-800">Rp {{ number_format(session('va_amount'), 0, ',', '.') }}</strong></p>
                                    @endif
                                    <p class="text-xs text-gray-500 mt-2">Salin kode VA di atas dan masukkan pada form di bawah</p>
                                </div>
                            @endif
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('payment.check') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Masukkan Kode VA</label>
                            <input type="text" name="va_number" required placeholder="VA20241206..."
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <button type="submit" class="btn-ripple w-full">
                            🔍 Cek VA
                        </button>
                    </form>

                    <div class="mt-6 p-4 bg-blue-50 rounded">
                        <p class="text-sm text-blue-800">
                            <strong>Info:</strong> Masukkan kode VA yang Anda dapatkan setelah checkout atau top up wallet.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyVA() {
            const vaText = document.getElementById('va-display').textContent;
            navigator.clipboard.writeText(vaText).then(() => {
                alert('Kode VA berhasil disalin!');
            }).catch(err => {
                console.error('Gagal menyalin:', err);
            });
        }
    </script>
</x-app-layout>
