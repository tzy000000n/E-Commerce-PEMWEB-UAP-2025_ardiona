<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('productCategory')
            ->where('store_id', auth()->user()->store->id)
            ->latest()
            ->paginate(10);

        return view('seller.products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::all();
        return view('seller.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'description_id' => 'nullable|string',
            'short_description' => 'nullable|string', // Should represent default/English
            'short_description_id' => 'nullable|string',
            'condition' => 'required|in:new,second',
            'price' => 'required|numeric|min:0',
            'weight' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $product = Product::create([
                'store_id' => auth()->user()->store->id,
                'product_category_id' => $request->product_category_id,
                'name' => $request->name,
                'slug' => Str::slug($request->name) . '-' . rand(1000, 9999),
                'description' => $request->description,
                'description_id' => $request->description_id,
                'short_description' => $request->short_description,
                'short_description_id' => $request->short_description_id,
                'condition' => $request->condition,
                'price' => $request->price,
                'weight' => $request->weight,
                'stock' => $request->stock,
            ]);

            // Upload images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store('products', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => Storage::url($path),
                        'is_thumbnail' => $index === 0,
                    ]);
                }
            } else {
                // Jika tidak ada gambar, buat placeholder
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'https://via.placeholder.com/500x500.png?text=' . urlencode($request->name),
                    'is_thumbnail' => true,
                ]);
            }

            return redirect()->route('seller.products.index')->with('success', 'Produk berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan produk: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $product = Product::with(['productCategory', 'productImages'])
            ->where('store_id', auth()->user()->store->id)
            ->findOrFail($id);

        return view('seller.products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::with('productImages')
            ->where('store_id', auth()->user()->store->id)
            ->findOrFail($id);
        $categories = ProductCategory::all();

        return view('seller.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('store_id', auth()->user()->store->id)->findOrFail($id);

        $request->validate([
            'product_category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'short_description' => 'required|string|max:255',
            'short_description_id' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_id' => 'nullable|string',
            'condition' => 'required|in:new,used',
            'price' => 'required|numeric|min:0',
            'weight' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product->update([
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . $product->id,
            'short_description' => $request->short_description,
            'short_description_id' => $request->short_description_id,
            'description' => $request->description,
            'description_id' => $request->description_id,
            'condition' => $request->condition,
            'price' => $request->price,
            'weight' => $request->weight,
            'stock' => $request->stock,
        ]);

        // Upload new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => Storage::url($path),
                    'is_thumbnail' => false,
                ]);
            }
        }

        return redirect()->route('seller.products.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $product = Product::where('store_id', auth()->user()->store->id)->findOrFail($id);

        // Delete images from storage
        foreach ($product->productImages as $image) {
            $path = str_replace('/storage/', '', $image->image);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        $product->delete();

        return redirect()->route('seller.products.index')->with('success', 'Produk berhasil dihapus');
    }

    public function deleteImage($id)
    {
        $image = ProductImage::findOrFail($id);

        // Verify ownership
        if ($image->product->store_id !== auth()->user()->store->id) {
            abort(403);
        }

        // Don't delete if it's the only image
        if ($image->product->productImages()->count() <= 1) {
            return back()->with('error', 'Produk harus memiliki minimal satu gambar');
        }

        // Delete file
        $path = str_replace('/storage/', '', $image->image);
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        // If it was thumbnail, set another one as thumbnail
        if ($image->is_thumbnail) {
            $image->delete();
            $newThumbnail = $image->product->productImages()->first();
            if ($newThumbnail) {
                $newThumbnail->update(['is_thumbnail' => true]);
            }
        } else {
            $image->delete();
        }

        return back()->with('success', 'Gambar berhasil dihapus');
    }

    public function setThumbnail($id)
    {
        $image = ProductImage::findOrFail($id);

        // Verify ownership
        if ($image->product->store_id !== auth()->user()->store->id) {
            abort(403);
        }

        // Reset all thumbnails for this product
        $image->product->productImages()->update(['is_thumbnail' => false]);

        // Set new thumbnail
        $image->update(['is_thumbnail' => true]);

        return back()->with('success', 'Thumbnail berhasil diperbarui');
    }
}
