<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::latest()->paginate(10);
        return view('seller.categories.index', compact('categories'));
    }
    
    public function create()
    {
        return view('seller.categories.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name',
            'tagline' => 'nullable|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $imagePath = 'https://via.placeholder.com/300x200.png?text=Category';
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $imagePath = Storage::url($imagePath);
        }
        
        ProductCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'tagline' => $request->tagline,
            'description' => $request->description,
            'image' => $imagePath,
        ]);
        
        return redirect()->route('seller.categories.index')->with('success', 'Kategori berhasil ditambahkan');
    }
    
    public function edit($id)
    {
        $category = ProductCategory::findOrFail($id);
        return view('seller.categories.edit', compact('category'));
    }
    
    public function update(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name,' . $id,
            'tagline' => 'nullable|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $data = $request->except('image');
        $data['slug'] = Str::slug($request->name);
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $data['image'] = Storage::url($imagePath);
        }
        
        $category->update($data);
        
        return redirect()->route('seller.categories.index')->with('success', 'Kategori berhasil diperbarui');
    }
    
    public function destroy($id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->delete();
        
        return redirect()->route('seller.categories.index')->with('success', 'Kategori berhasil dihapus');
    }
}
