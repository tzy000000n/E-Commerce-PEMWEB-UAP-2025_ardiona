<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto px-6">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl"
                style="border: 3px solid rgba(102, 126, 234, 0.3);">
                <div class="p-8">
                    <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">{{ __('app.payment_confirmation') }}
                    </h1>

                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-300">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Detail Tagihan -->
                    <div class="bg-indigo-50 p-6 rounded-xl border border-indigo-100 mb-8">
                        <div class="flex justify-between items-center mb-4 border-b border-indigo-200 pb-4">
                            <span class="text-gray-600">{{ __('app.va_review_code') }}</span>
                            <span
                                class="font-mono font-bold text-lg text-indigo-700">{{ $virtualAccount->va_number }}</span>
                        </div>

                        <div class="flex justify-between items-center mb-4">
                            <span class="text-gray-600">{{ __('app.transaction_type') }}</span>
                            <span
                                class="px-3 py-1 bg-indigo-200 text-indigo-800 rounded-full text-sm font-semibold capitalize">
                                {{ $virtualAccount->type == 'topup' ? __('app.topup_wallet') : __('app.payment_order') }}
                            </span>
                        </div>

                        <div class="flex justify-between items-center pt-2">
                            <span class="text-gray-600 font-medium">{{ __('app.bill_total') }}</span>
                            <span class="text-3xl font-bold text-gray-900">Rp
                                {{ number_format($virtualAccount->amount, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Form Simulasi Pembayaran -->
                    <form action="{{ route('payment.confirm') }}" method="POST" x-data="{ amount: '' }">
                        @csrf
                        <input type="hidden" name="va_number" value="{{ $virtualAccount->va_number }}">

                        <div class="mb-6">
                            <label
                                class="block text-sm font-medium text-gray-700 mb-2">{{ __('app.enter_payment_amount') }}</label>

                            <!-- Hidden input for raw number -->
                            <input type="hidden" name="amount" x-model="amount">

                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                </div>
                                <input type="text"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-lg border-gray-300 rounded-md py-3"
                                    placeholder="0" x-on:input="
                                        let val = $el.value.replace(/\D/g, '');
                                        amount = val;
                                        $el.value = val.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                                    " required>
                            </div>
                            <p class="mt-2 text-xs text-gray-500 text-center">
                                *{{ __('app.simulation_info') }}
                                ({{ number_format($virtualAccount->amount, 0, ',', '.') }})
                            </p>
                        </div>

                        <button type="submit"
                            class="w-full flex justify-center py-4 px-4 border border-transparent rounded-lg shadow-sm text-lg font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200"
                            :class="{'opacity-50 cursor-not-allowed': amount != {{ $virtualAccount->amount }} }"
                            :disabled="amount != {{ $virtualAccount->amount }}">
                            {{ __('app.pay_now') }}
                        </button>
                    </form>

                    <div class="mt-6 text-center">
                        <a href="{{ route('home') }}" class="text-indigo-600 hover:text-indigo-500 text-sm font-medium">
                            {{ __('app.cancel_return') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>