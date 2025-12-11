<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = ProductCategory::all();

        // Featured products untuk homepage - specific products by slug
        $featuredSlugs = [
            'dk-legacy-varsity-jacket',
            'renaissance-washed-tee',
            'cream-dust-la-stella-sweater',
            'black-dust-la-stella-knit',
            'dk-obsidian-panel-leather-pants',
            'rebel-silver-wallet-chain',
            'midnight-rider-leather-jacket'
        ];

        $products = Product::with(['store', 'productCategory', 'productImages'])
            ->whereIn('slug', $featuredSlugs)
            ->where('stock', '>', 0)
            ->get()
            ->sortBy(function ($product) use ($featuredSlugs) {
                return array_search($product->slug, $featuredSlugs);
            });

        return view('home', compact('products', 'categories'));
    }
}
