<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = ProductCategory::all();
        
        $query = Product::with(['store', 'productCategory']);
        
        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('product_category_id', $request->category);
        }
        
        // Search
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $products = $query->where('stock', '>', 0)->latest()->paginate(12);
        
        return view('shop', compact('products', 'categories'));
    }
}
