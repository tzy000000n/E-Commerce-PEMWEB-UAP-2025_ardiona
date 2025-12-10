<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Produk') }}
        </h2>
    </x-slot>

    <style>
        /* Tetap pertahankan fix untuk input field agar bisa diedit */
        input, textarea, select {
            pointer-events: auto !important;
            user-select: text !important;
            -webkit-user-select: text !important;
            -moz-user-select: text !important;
            -ms-user-select: text !important;
        }
        
        input:focus, textarea:focus, select:focus {
            outline: 2px solid #4f46e5 !important;
            outline-offset: 2px !important;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('seller.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="product_category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                <select name="product_category_id" id="product_category_id" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('product_category_id', $product->product_category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_category_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="short_description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat</label>
                                <input type="text" name="short_description" id="short_description" value="{{ old('short_description', $product->short_description) }}" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @error('short_description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Lengkap</label>
                                <textarea name="description" id="description" rows="4" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp)</label>
                                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="weight" class="block text-sm font-medium text-gray-700 mb-2">Berat (gram)</label>
                                <input type="number" name="weight" id="weight" value="{{ old('weight', $product->weight) }}" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @error('weight')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                                <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @error('stock')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="condition" class="block text-sm font-medium text-gray-700 mb-2">Kondisi</label>
                                <select name="condition" id="condition" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    <option value="new" {{ old('condition', $product->condition) == 'new' ? 'selected' : '' }}>Baru</option>
                                    <option value="used" {{ old('condition', $product->condition) == 'used' ? 'selected' : '' }}>Bekas</option>
                                </select>
                                @error('condition')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-8 border-t pt-6">
                                <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                                    
                                    <div class="w-full md:w-1/3">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload Gambar Baru (Opsional)</label>
                                        <input type="file" name="images[]" id="images" multiple accept="image/*"
                                            class="block w-full text-sm text-gray-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-indigo-50 file:text-indigo-700
                                            hover:file:bg-indigo-100
                                            cursor-pointer">
                                        <p class="mt-2 text-xs text-gray-500">Upload gambar baru jika ingin mengganti.</p>
                                        @error('images')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="w-full md:w-1/3 flex flex-col items-center">
                                        <label class="block text-sm font-medium text-gray-700 mb-4">Gambar Saat Ini</label>
                                        
                                        @if($product->productImages->count() > 0)
                                            <div class="flex flex-wrap gap-4 justify-center">
                                                @foreach($product->productImages as $image)
                                                    <div class="relative group">
                                                        <img src="{{ asset($image->image) }}" alt="Product Image" 
                                                             class="w-40 h-40 object-cover rounded-xl border shadow-md hover:shadow-lg transition-shadow duration-200">
                                                        
                                                        @if($image->is_thumbnail)
                                                            <span class="absolute -top-3 -right-3 bg-green-500 text-white text-xs px-2 py-1 rounded-full shadow-sm z-10">
                                                                Thumbnail
                                                            </span>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="py-8 px-6 border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 text-center w-full">
                                                <p class="text-sm text-gray-400">Belum ada gambar</p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="w-full md:w-1/3 flex justify-end items-center">
                                        <button type="submit" 
                                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg shadow-md transition-all duration-200 w-full md:w-auto text-center">
                                            Update Produk
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-10 flex justify-center">
                                <a href="{{ route('seller.products.index') }}" 
                                    class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-6 rounded-lg transition-colors duration-200">
                                    Kembali
                                </a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>