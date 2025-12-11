<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('app.withdrawal_management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Admin Navigation -->
            <div class="mb-6 flex gap-4">
                <a href="{{ route('admin.verification.index') }}"
                    class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                    {{ __('app.store_verification') }}
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                    {{ __('app.user_management') }}
                </a>
                <a href="{{ route('admin.stores.index') }}"
                    class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                    {{ __('app.store_management') }}
                </a>
                <a href="{{ route('admin.withdrawals.index') }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    {{ __('app.withdrawal_management') }}
                </a>
            </div>


            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

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
                                        {{ __('app.store') }}
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('app.bank_name') }}
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('app.amount') }}
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
                                @forelse($withdrawals as $withdrawal)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $withdrawal->created_at->format('d M Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $withdrawal->storeBalance->store->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $withdrawal->bank_name }} - {{ $withdrawal->bank_account_number }}<br>
                                            <span class="text-xs">a.n {{ $withdrawal->bank_account_name }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}
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
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if($withdrawal->status == 'pending')
                                                <div class="flex space-x-2">
                                                    <form action="{{ route('admin.withdrawals.update', $withdrawal->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('{{ __('app.confirm_approve') }}');">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="approved">
                                                        <button type="submit"
                                                            class="text-green-600 hover:text-green-900">{{ __('app.approve') }}</button>
                                                    </form>

                                                    <form action="{{ route('admin.withdrawals.update', $withdrawal->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('{{ __('app.confirm_reject') }}');">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button type="submit"
                                                            class="text-red-600 hover:text-red-900">{{ __('app.reject') }}</button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="text-gray-400">{{ __('app.processed') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
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
</x-app-layout>