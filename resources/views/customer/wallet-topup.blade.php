<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Balance Card Section -->
            <div class="mb-8">
                <div class="relative overflow-hidden rounded-2xl shadow-xl text-white px-10"
                    style="background: linear-gradient(135deg, #4f46e5 0%, #7e22ce 100%); padding-top: 1rem; padding-bottom: 1rem;">
                    <!-- Decorative Circles behind -->
                    <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-white opacity-10 blur-xl">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 -ml-8 -mb-8 w-32 h-32 rounded-full bg-white opacity-10 blur-xl">
                    </div>

                    <div class="relative z-10 flex flex-col items-center justify-center text-center">
                        <p class="text-indigo-100 text-sm font-medium tracking-wider uppercase mb-2">
                            {{ __('app.current_balance') }}
                        </p>
                        <h2 class="text-5xl font-extrabold tracking-tight mb-1">
                            Rp {{ number_format($userBalance->balance, 0, ',', '.') }}
                        </h2>
                        <span class="text-indigo-200 text-xs">Available for Withdrawal & Shopping</span>
                    </div>
                </div>
            </div>

            <!-- Top Up Form Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-10 pt-10" style="padding-bottom: 1rem;">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 px-2">{{ __('app.topup_wallet') }}</h3>

                    <form action="{{ route('wallet.topup.store') }}" method="POST" x-data="{ amount: '' }">
                        @csrf

                        <div class="space-y-6 px-2">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2">{{ __('app.topup_amount') }}</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                        <span class="text-gray-500 sm:text-lg font-semibold">Rp</span>
                                    </div>
                                    <input type="hidden" name="amount" x-model="amount">
                                    <input type="text" required placeholder="0"
                                        class="block w-full rounded-lg border-gray-300 pl-12 pr-4 py-4 text-xl focus:border-indigo-500 focus:ring-indigo-500 placeholder-gray-300"
                                        x-on:input="
                                                let val = $el.value.replace(/\D/g, '');
                                                amount = val;
                                                $el.value = val.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                                           ">
                                </div>
                                <p class="mt-2 text-sm text-gray-500 flex justify-between">
                                    <span>{{ __('app.min_topup') }}</span>
                                    <span :class="{'text-green-600': amount >= 10000, 'text-gray-400': amount < 10000}"
                                        x-text="amount >= 10000 ? 'Valid Amount' : 'Enter amount'"></span>
                                </p>
                            </div>

                            <button type="submit"
                                class="w-auto flex justify-center py-4 px-6 border border-transparent rounded-lg shadow-sm text-base font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200 mb-8"
                                :disabled="amount < 10000"
                                :class="{'opacity-50 cursor-not-allowed': amount < 10000, 'hover:shadow-lg transform hover:-translate-y-0.5': amount >= 10000}">
                                {{ __('app.topup_now') }}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Instructions Footer -->
                <div class="bg-gray-50 px-8 py-6 border-t border-gray-100">
                    <h4 class="text-sm font-semibold text-gray-900 mb-3">{{ __('app.topup_instructions') }}</h4>
                    <ul class="space-y-2">
                        <li class="flex items-start text-sm text-gray-600">
                            <span
                                class="mr-2 flex-shrink-0 h-5 w-5 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-bold">1</span>
                            {{ __('app.topup_step_1') }}
                        </li>
                        <li class="flex items-start text-sm text-gray-600">
                            <span
                                class="mr-2 flex-shrink-0 h-5 w-5 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-bold">2</span>
                            {{ __('app.topup_step_2') }}
                        </li>
                        <li class="flex items-start text-sm text-gray-600">
                            <span
                                class="mr-2 flex-shrink-0 h-5 w-5 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-bold">3</span>
                            {{ __('app.topup_step_3') }}
                        </li>
                        <li class="flex items-start text-sm text-gray-600">
                            <span
                                class="mr-2 flex-shrink-0 h-5 w-5 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-bold">4</span>
                            {{ __('app.topup_step_4') }}
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>