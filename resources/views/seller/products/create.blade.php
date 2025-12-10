<x-app-layout>
    <div class="py-4">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-bold mb-6">Tambah Produk Baru</h1>

                    @if($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                <select name="product_category_id" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                                <textarea name="description" rows="4" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kondisi</label>
                                    <select name="condition" required
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="new">Baru</option>
                                        <option value="second">Bekas</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                                    <input type="number" name="price" required min="0"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Berat (gram)</label>
                                    <input type="number" name="weight" required min="0"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                                    <input type="number" name="stock" required min="0"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Produk</label>
                                <input type="file" name="images[]" multiple accept="image/*"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <p class="text-sm text-gray-500 mt-1">Upload beberapa gambar (gambar pertama akan jadi thumbnail)</p>
                            </div>
                        </div>

                        <div class="flex gap-4 mt-6">
                            <button type="submit" class="flex-1 px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 font-semibold" onclick="console.log('Button clicked')">
                                Simpan Produk
                            </button>
                            <a href="{{ route('seller.products.index') }}" 
                                class="px-6 py-3 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 font-semibold text-center">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
