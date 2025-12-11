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
                <a href="{{ route('seller.balance.index') }}"
                    class="px-4 py-2 {{ request()->routeIs('seller.balance.*') ? 'bg-indigo-600 text-white' : 'bg-gray-600 text-white hover:bg-gray-700' }} rounded-lg transition">
                    {{ __('app.balance_and_withdraw') }}
                </a>
            </div>

            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                {{ __('app.financial_dashboard') }}
            </h2>

            <!-- Balance Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div
                    class="p-6 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg shadow-lg relative overflow-hidden">
                    <div class="absolute right-0 top-0 opacity-10 transform translate-x-10 -translate-y-10">
                        <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <h3 class="text-lg font-medium opacity-90 mb-1">{{ __('app.total_balance') }}</h3>
                        <p class="text-4xl font-bold mb-4">Rp {{ number_format($storeBalance->balance, 0, ',', '.') }}
                        </p>
                        <div class="flex gap-3">
                            <a href="{{ route('seller.withdrawals.index') }}"
                                class="bg-white text-indigo-600 px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition shadow-md flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ __('app.withdraw_funds') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction History Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('app.transaction_history') }}</h3>

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
                                        {{ __('app.description') }}
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('app.type') }}
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('app.amount') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($histories as $history)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $history->created_at->format('d M Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            {{ $history->description }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($history->type == 'credit')
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ __('app.income') }}
                                                </span>
                                            @else
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    {{ __('app.expense') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-bold {{ $history->type == 'credit' ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $history->type == 'credit' ? '+' : '-' }} Rp
                                            {{ number_format($history->amount, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                            {{ __('app.no_transaction_history') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $histories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>