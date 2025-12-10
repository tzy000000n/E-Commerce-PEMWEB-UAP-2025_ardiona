<x-app-layout>
    <div class="py-4">
        <div class="max-w-2xl mx-auto px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-bold mb-6">Daftar Sebagai Penjual</h1>

                    <form action="{{ route('store.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Toko</label>
                                <input type="text" name="name" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Logo Toko</label>
                                <input type="file" name="logo" accept="image/*"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tentang Toko</label>
                                <textarea name="about" rows="4" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                <input type="text" name="phone" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                                <input type="text" name="city" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                                <textarea name="address" rows="3" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                                <input type="text" name="postal_code" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <button type="submit" class="mt-6 w-full px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 font-semibold">
                            Daftar Toko
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
