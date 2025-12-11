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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('app.category') }}
                        </h2>
                        <a href="{{ route('seller.categories.create') }}"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            + {{ __('app.category') }}
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Icon
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('app.category') }}
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Slug
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('app.action') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($categories as $category)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($category->icon)
                                                <img src="{{ asset($category->icon) }}" alt="{{ $category->name }}"
                                                    class="h-10 w-10 object-cover rounded">
                                            @else
                                                <div class="h-10 w-10 bg-gray-200 rounded flex items-center justify-center">
                                                    <span class="text-xs text-gray-500">No Icon</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $category->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $category->slug }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('seller.categories.edit', $category->id) }}"
                                                    class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                <form action="{{ route('seller.categories.destroy', $category->id) }}"
                                                    method="POST" onsubmit="return confirm('{{ __('app.confirm_delete') }}');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900">{{ __('app.delete') }}</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                            {{ __('app.no_categories', ['default' => 'Tidak ada kategori']) }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>