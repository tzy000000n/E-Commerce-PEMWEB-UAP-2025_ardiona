<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                Manajemen Toko
            </h2>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Profil Toko</h3>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('seller.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Logo -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Logo Toko</label>
                            @if($store->logo)
                                <img src="{{ asset('storage/' . $store->logo) }}" alt="Logo"
                                    class="w-32 h-32 object-cover rounded mb-2">
                            @endif
                            <input type="file" name="logo"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <!-- Name -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Toko</label>
                            <input type="text" name="name" value="{{ old('name', $store->name) }}" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <!-- About -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Toko</label>
                            <textarea name="about" rows="4" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('about', $store->about) }}</textarea>
                        </div>

                        <!-- Phone -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nomor Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone', $store->phone) }}" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- City -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Kota</label>
                                <input type="text" name="city" value="{{ old('city', $store->city) }}" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>

                            <!-- Postal Code -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Kode Pos</label>
                                <input type="text" name="postal_code"
                                    value="{{ old('postal_code', $store->postal_code) }}" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Alamat Lengkap</label>
                            <textarea name="address" rows="3" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('address', $store->address) }}</textarea>
                        </div>

                        <hr class="my-6 border-gray-300">

                        <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Rekening Bank (Untuk Penarikan)</h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Bank Name -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Bank</label>
                                <select name="bank_name"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="">Pilih Bank</option>
                                    <option value="BCA" @selected(old('bank_name', $store->bank_name) == 'BCA')>BCA
                                    </option>
                                    <option value="Mandiri" @selected(old('bank_name', $store->bank_name) == 'Mandiri')>
                                        Mandiri</option>
                                    <option value="BNI" @selected(old('bank_name', $store->bank_name) == 'BNI')>BNI
                                    </option>
                                    <option value="BRI" @selected(old('bank_name', $store->bank_name) == 'BRI')>BRI
                                    </option>
                                    <option value="Jago" @selected(old('bank_name', $store->bank_name) == 'Jago')>Jago
                                    </option>
                                </select>
                            </div>

                            <!-- Account Number -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Nomor Rekening</label>
                                <input type="text" name="bank_account_number"
                                    value="{{ old('bank_account_number', $store->bank_account_number) }}"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>

                            <!-- Account Name -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Atas Nama</label>
                                <input type="text" name="bank_account_name"
                                    value="{{ old('bank_account_name', $store->bank_account_name) }}"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Store Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-red-200">
                <div class="p-6 bg-white">
                    <h3 class="text-lg font-medium text-red-600 mb-2">Hapus Toko</h3>
                    <p class="text-sm text-gray-600 mb-4">Tindakan ini tidak dapat dibatalkan. Semua produk dan data
                        toko akan dihapus permanen.</p>

                    <form action="{{ route('seller.profile.destroy') }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus toko ini? Semua data akan hilang.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Hapus Toko Permanen
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>