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
                                <label for="short_description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat (EN)</label>
                                <input type="text" name="short_description" id="short_description" value="{{ old('short_description', $product->short_description) }}" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @error('short_description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                             <div>
                                <label for="short_description_id" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat (ID)</label>
                                <input type="text" name="short_description_id" id="short_description_id" value="{{ old('short_description_id', $product->short_description_id) }}" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('short_description_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Lengkap (EN)</label>
                                <textarea name="description" id="description" rows="4" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                             <div>
                                <label for="description_id" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Lengkap (ID)</label>
                                <textarea name="description_id" id="description_id" rows="4" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description_id', $product->description_id) }}</textarea>
                                @error('description_id')
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

                                    <div class="w-full md:w-2/3 flex flex-col items-center">
                                        <label class="block text-sm font-medium text-gray-700 mb-4">Gambar Saat Ini</label>
                                        
                                        @if($product->productImages->count() > 0)
                                            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 w-full">
                                                @foreach($product->productImages as $image)
                                                    <div class="relative group bg-gray-50 p-2 rounded-lg border">
                                                        <img src="{{ asset($image->image) }}" alt="Product Image" 
                                                             class="w-full h-32 object-cover rounded shadow-sm mb-2">
                                                        
                                                        @if($image->is_thumbnail)
                                                            <div class="absolute -top-2 -right-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full shadow z-10 font-bold">
                                                                Main
                                                            </div>
                                                            <div class="text-center text-xs text-green-600 font-bold p-1 bg-green-50 rounded">
                                                                Thumbnail
                                                            </div>
                                                        @else
                                                            <div class="flex gap-1 justify-between mt-2">
                                                                <!-- Set Thumbnail Button -->
                                                                <button type="submit" form="set-thumbnail-{{ $image->id }}"
                                                                    class="flex-1 text-xs bg-indigo-100 text-indigo-700 py-1 px-2 rounded hover:bg-indigo-200"
                                                                    title="Jadikan Thumbnail">
                                                                    Set Main
                                                                </button>
                                                                
                                                                <!-- Delete Button -->
                                                                <button type="submit" form="delete-image-{{ $image->id }}"
                                                                    class="text-xs bg-red-100 text-red-700 py-1 px-2 rounded hover:bg-red-200"
                                                                    onclick="return confirm('Hapus gambar ini?')"
                                                                    title="Hapus Gambar">
                                                                    Del
                                                                </button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>

                                            {{-- Forms for Actions (Outside loop to prevent nesting issues) --}}
                                            @foreach($product->productImages as $image)
                                                @if(!$image->is_thumbnail)
                                                    <form id="set-thumbnail-{{ $image->id }}" action="{{ route('seller.products.image.thumbnail', $image->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('PATCH')
                                                    </form>
                                                    <form id="delete-image-{{ $image->id }}" action="{{ route('seller.products.image.delete', $image->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @endif
                                            @endforeach
                                        @else
                                            <div class="py-12 px-6 border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 text-center w-full">
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