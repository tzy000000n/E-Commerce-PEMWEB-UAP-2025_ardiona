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
                {{ __('app.order_management') }}
            </h2>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
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
                                        {{ __('app.order_id') }}
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('app.customer') }}
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('app.total_price') }}
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('app.status') }}
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('app.action') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($orders as $order)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $order->created_at->format('d M Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            #{{ $order->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $order->user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                        @if($order->payment_status === 'paid') bg-green-100 text-green-800 
                                                        @elseif($order->payment_status === 'unpaid') bg-yellow-100 text-yellow-800 
                                                        @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst($order->payment_status) }}
                                            </span>
                                            @if($order->tracking_number)
                                                <div class="text-xs text-gray-500 mt-1">
                                                    Resi: {{ $order->tracking_number }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('seller.orders.show', $order->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900">
                                                {{ __('app.view_detail') }}
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                            {{ __('app.no_orders') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>