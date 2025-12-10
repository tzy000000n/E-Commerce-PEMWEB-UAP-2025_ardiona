<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Outerwear',
                'tagline' => 'Jackets, Coats & Hoodies',
                'description' => 'Premium outerwear collection including jackets, coats, and hoodies',
                'image' => 'https://via.placeholder.com/300x200.png?text=Outerwear',
            ],
            [
                'name' => 'T-Shirts',
                'tagline' => 'Comfortable & Stylish Tees',
                'description' => 'High-quality t-shirts with unique designs and comfortable fits',
                'image' => 'https://via.placeholder.com/300x200.png?text=T-Shirts',
            ],
            [
                'name' => 'Bottoms',
                'tagline' => 'Pants, Jeans & Shorts',
                'description' => 'Versatile bottoms collection for every occasion',
                'image' => 'https://via.placeholder.com/300x200.png?text=Bottoms',
            ],
            [
                'name' => 'Accessories',
                'tagline' => 'Complete Your Look',
                'description' => 'Hats, bags, and accessories to complement your style',
                'image' => 'https://via.placeholder.com/300x200.png?text=Accessories',
            ],
        ];

        foreach ($categories as $category) {
            ProductCategory::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'tagline' => $category['tagline'],
                'description' => $category['description'],
                'image' => $category['image'],
            ]);
        }
    }
}
