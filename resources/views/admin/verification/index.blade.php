<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Admin Navigation -->
            <div class="mb-6 flex gap-4">
                <a href="{{ route('admin.verification.index') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Verifikasi Toko
                </a>
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                    Manajemen User
                </a>
                <a href="{{ route('admin.stores.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                    Manajemen Toko
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-bold mb-6">Verifikasi Toko</h1>

                    @forelse($stores as $store)
                        <div class="mb-4 p-4 border rounded">
                            <div class="flex justify-between items-start">
                                <div class="flex gap-4">
                                    <img src="{{ $store->logo }}" alt="{{ $store->name }}" class="w-20 h-20 object-cover rounded">
                                    <div>
                                        <h3 class="font-semibold text-lg">{{ $store->name }}</h3>
                                        <p class="text-sm text-gray-600">Owner: {{ $store->user->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $store->city }}</p>
                                        <p class="text-sm text-gray-600 mt-2">{{ $store->about }}</p>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <form action="{{ route('admin.verification.approve', $store->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                            Setujui
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.verification.reject', $store->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin tolak toko ini?')">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-8">Tidak ada toko yang menunggu verifikasi</p>
                    @endforelse

                    <div class="mt-4">
                        {{ $stores->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
