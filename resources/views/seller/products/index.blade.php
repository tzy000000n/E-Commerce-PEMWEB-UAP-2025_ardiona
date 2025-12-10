<x-app-layout>
    <div class="py-4">
        <div class="max-w-full mx-auto" style="padding-left: 3rem; padding-right: 3rem;">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">Manajemen Produk</h1>
                        <a href="{{ route('seller.products.create') }}" 
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            + Tambah Produk
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase" style="width: 40%;">Produk</th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase" style="width: 15%;">Kategori</th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase" style="width: 15%;">Harga</th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase" style="width: 10%;">Stok</th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase" style="width: 20%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($products as $product)
                                    <tr>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center gap-4">
                                                <div class="product-image-zoom rounded" style="width: 80px; height: 80px; flex-shrink: 0; overflow: hidden;">
                                                    @if($product->productImages->first())
                                                        <img src="{{ asset($product->productImages->first()->image) }}" 
                                                            alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                                    @else
                                                        <img src="https://via.placeholder.com/80x80/e5e7eb/9ca3af?text=No+Image" 
                                                            alt="No Image" style="width: 100%; height: 100%; object-fit: cover;">
                                                    @endif
                                                </div>
                                                <span class="font-medium text-gray-800">{{ $product->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-center text-gray-700">{{ $product->productCategory->name }}</td>
                                        <td class="px-4 py-4 text-center text-gray-700">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-4 text-center text-gray-700">{{ $product->stock }}</td>
                                        <td class="px-4 py-4">
                                            <div class="flex gap-3 justify-center">
                                                <a href="{{ route('seller.products.edit', $product->id) }}" 
                                                    class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                                                <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST" 
                                                    onsubmit="return confirm('Yakin hapus produk ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">Belum ada produk</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
