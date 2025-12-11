<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Seller Sub-Navigation -->
            <div class="mb-6 flex gap-4">
                <a href="{{ route('seller.products.index') }}"
                    class="px-4 py-2 {{ request()->routeIs('seller.products.*') ? 'bg-indigo-600 text-white' : 'bg-gray-600 text-white hover:bg-gray-700' }} rounded-lg transition">
                    {{ __('app.seller') }}
                </a>
                <a href="{{ route('seller.categories.index') }}"
                    class="px-4 py-2 {{ request()->routeIs('seller.categories.*') ? 'bg-indigo-600 text-white' : 'bg-gray-600 text-white hover:bg-gray-700' }} rounded-lg transition">
                    {{ __('app.category') }}
                </a>
                <a href="{{ route('seller.orders.index') }}"
                    class="px-4 py-2 {{ request()->routeIs('seller.orders.*') ? 'bg-indigo-600 text-white' : 'bg-gray-600 text-white hover:bg-gray-700' }} rounded-lg transition">
                    {{ __('app.order_management') }}
                </a>
                <a href="{{ route('seller.withdrawals.index') }}"
                    class="px-4 py-2 {{ request()->routeIs('seller.withdrawals.*') ? 'bg-indigo-600 text-white' : 'bg-gray-600 text-white hover:bg-gray-700' }} rounded-lg transition">
                    {{ __('app.balance_and_withdraw') }}
                </a>
            </div>

            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                {{ __('app.balance_and_withdraw') }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Info Saldo & Form Withdraw -->
                <div class="md:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('app.active_balance') }}</h3>
                            <p class="text-3xl font-bold text-indigo-600">Rp
                                {{ number_format($storeBalance->balance, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('app.request_withdrawal') }}</h3>

                            @if(session('success'))
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                                    role="alert">
                                    <span class="block sm:inline">{{ session('success') }}</span>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                                    role="alert">
                                    <span class="block sm:inline">{{ session('error') }}</span>
                                </div>
                            @endif

                            <form action="{{ route('seller.withdrawals.store') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">{{ __('app.withdrawal_amount') }}</label>
                                    <input type="text" id="amount_display" 
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        placeholder="0" required>
                                    <input type="hidden" name="amount" id="amount_input">
                                    <p class="text-xs text-gray-500 mt-1">{{ __('app.min_withdrawal') }}</p>
                                </div>

                                <script>
                                    const amountDisplay = document.getElementById('amount_display');
                                    const amountInput = document.getElementById('amount_input');

                                    amountDisplay.addEventListener('input', function(e) {
                                        // Hapus karakter non-digit
                                        let value = this.value.replace(/[^0-9]/g, '');
                                        
                                        // Update hidden input (nilai asli untuk backend)
                                        amountInput.value = value;
                                        
                                        // Format display dengan separator ribuan
                                        if (value) {
                                            this.value = new Intl.NumberFormat('id-ID').format(value);
                                        } else {
                                            this.value = '';
                                        }
                                    });
                                </script>

                                <div class="mb-4">
                                    <label
                                        class="block text-gray-700 text-sm font-bold mb-2">{{ __('app.bank_name') }}</label>
                                    <select name="bank_name" required
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="">{{ __('app.select_bank') }}</option>
                                        <option value="BCA">BCA</option>
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="BNI">BNI</option>
                                        <option value="BRI">BRI</option>
                                        <option value="Jago">Jago</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label
                                        class="block text-gray-700 text-sm font-bold mb-2">{{ __('app.account_number') }}</label>
                                    <input type="text" name="bank_account_number" required
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>

                                <div class="mb-4">
                                    <label
                                        class="block text-gray-700 text-sm font-bold mb-2">{{ __('app.account_name') }}</label>
                                    <input type="text" name="bank_account_name" required
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>

                                <button type="submit"
                                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                    {{ $storeBalance->balance < 50000 ? 'disabled' : '' }}>
                                    {{ __('app.withdraw_funds') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- History -->
                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('app.withdrawal_history') }}</h3>

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('app.date') }}
                                            </th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('app.amount') }}
                                            </th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('app.destination') }}
                                            </th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('app.status') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($withdrawals as $withdrawal)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $withdrawal->created_at->format('d M Y H:i') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                                    Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $withdrawal->bank_name }} - {{ $withdrawal->bank_account_number }}
                                                    <br>
                                                    <span class="text-xs">a.n {{ $withdrawal->bank_account_name }}</span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if($withdrawal->status == 'pending')
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                            {{ __('app.pending') }}
                                                        </span>
                                                    @elseif($withdrawal->status == 'approved')
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            {{ __('app.approved') }}
                                                        </span>
                                                    @elseif($withdrawal->status == 'rejected')
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                            {{ __('app.rejected') }}
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                                    {{ __('app.no_withdrawal_history') }}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4">
                                {{ $withdrawals->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>