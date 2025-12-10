<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus produk lama terlebih dahulu (delete child dulu, baru parent)
        ProductImage::query()->delete();
        Product::query()->delete();
        
        $products = [
            // DION'S STORE (store_id = 1) - Outerwear & T-Shirts
            [
                'store_id' => 1,
                'product_category_id' => 1,
                'name' => 'DK Legacy Varsity Jacket',
                'short_description' => 'Premium Wool Varsity',
                'description' => 'Crafted with a premium wool body and vegan leather sleeves, featuring chenille embroidery for a timeless collegiate look.',
                'condition' => 'new',
                'price' => 1899000,
                'weight' => 800,
                'stock' => 25,
                'image' => 'images/products/outerwear/dk-legacy-varsity.jpg',
            ],
            [
                'store_id' => 1,
                'product_category_id' => 1,
                'name' => 'Midnight Rider Leather Jacket',
                'short_description' => 'Vintage Biker Leather',
                'description' => 'A rebellious biker silhouette with a vintage brown finish and heavy-duty hardware for the ultimate night rider aesthetic.',
                'condition' => 'new',
                'price' => 2499000,
                'weight' => 1200,
                'stock' => 15,
                'image' => 'images/products/outerwear/midnight-rider-leather.jpg',
            ],
            [
                'store_id' => 1,
                'product_category_id' => 1,
                'name' => 'Urban Ops Bomber Hoodie',
                'short_description' => 'Tactical Hybrid Bomber',
                'description' => 'Hybrid tactical bomber featuring a built-in jersey hood and utility pockets, designed for modern urban exploration.',
                'condition' => 'new',
                'price' => 1599000,
                'weight' => 700,
                'stock' => 30,
                'image' => 'images/products/outerwear/urban-ops-bomber.jpg',
            ],
            [
                'store_id' => 1,
                'product_category_id' => 2,
                'name' => 'DK Legacy Cherub Tee',
                'short_description' => 'Oversized Cherub Tee',
                'description' => 'Oversized fit in vintage cream, highlighting a Renaissance-inspired cherub graphic with signature script branding.',
                'condition' => 'new',
                'price' => 599000,
                'weight' => 300,
                'stock' => 50,
                'image' => 'images/products/tshirts/dk-legacy-cherub.jpg',
            ],
            [
                'store_id' => 1,
                'product_category_id' => 2,
                'name' => 'Renaissance Washed Tee',
                'short_description' => 'Gothic Washed Tee',
                'description' => 'Heavyweight cotton with a gothic-style graphic and acid-washed finish, delivering a perfect grunge aesthetic.',
                'condition' => 'new',
                'price' => 599000,
                'weight' => 300,
                'stock' => 45,
                'image' => 'images/products/tshirts/renaissance-washed.jpg',
            ],
            
            // KHEIZA'S STORE (store_id = 2) - Bottoms & Accessories
            [
                'store_id' => 2,
                'product_category_id' => 3,
                'name' => 'DK Brutalist Concrete Tech-Pants',
                'short_description' => 'Concrete Tech Trousers',
                'description' => 'Futuristic technical trousers featuring a unique concrete-wash texture and structural knee panels for an industrial look.',
                'condition' => 'new',
                'price' => 1299000,
                'weight' => 600,
                'stock' => 30,
                'image' => 'images/products/bottoms/brutalist-concrete.jpg',
            ],
            [
                'store_id' => 2,
                'product_category_id' => 3,
                'name' => 'Wasteland Grunge Cargo',
                'short_description' => 'Shadow Camo Cargo',
                'description' => 'Utility-focused cargo pants with a dark shadow-camo print and multiple pockets, built for the post-apocalyptic trend.',
                'condition' => 'new',
                'price' => 1199000,
                'weight' => 650,
                'stock' => 35,
                'image' => 'images/products/bottoms/wasteland-cargo.jpg',
            ],
            [
                'store_id' => 2,
                'product_category_id' => 3,
                'name' => 'DK Obsidian Panel Leather Pants',
                'short_description' => 'Panel Leather Pants',
                'description' => 'Sleek faux leather trousers with architectural knee panels, offering a sharp and edgy silhouette for evening wear.',
                'condition' => 'new',
                'price' => 1799000,
                'weight' => 700,
                'stock' => 20,
                'image' => 'images/products/bottoms/obsidian-panel.jpg',
            ],
            [
                'store_id' => 2,
                'product_category_id' => 4,
                'name' => 'DK Owners Club Varsity Cap',
                'short_description' => 'Owners Club Cap',
                'description' => 'Classic cream dad hat featuring bold "Owners Club" embroidery, marking your entry into the exclusive DK community.',
                'condition' => 'new',
                'price' => 399000,
                'weight' => 150,
                'stock' => 60,
                'image' => 'images/products/accessories/owners-club-cap.jpg',
            ],
            [
                'store_id' => 2,
                'product_category_id' => 4,
                'name' => 'DK Shadow Camo Beanie',
                'short_description' => 'Dark Camo Beanie',
                'description' => 'Ribbed knit beanie in a subtle dark camouflage pattern, providing essential warmth with a tactical edge.',
                'condition' => 'new',
                'price' => 299000,
                'weight' => 100,
                'stock' => 70,
                'image' => 'images/products/accessories/shadow-camo-beanie.jpg',
            ],
            [
                'store_id' => 2,
                'product_category_id' => 4,
                'name' => 'Rebel Silver Wallet Chain',
                'short_description' => 'Gothic Wallet Chain',
                'description' => 'Heavy-duty silver chain with intricate gothic links, the perfect finishing accessory for your denim or leather pants.',
                'condition' => 'new',
                'price' => 499000,
                'weight' => 200,
                'stock' => 40,
                'image' => 'images/products/accessories/rebel-wallet-chain.jpg',
            ],
        ];

        foreach ($products as $product) {
            $newProduct = Product::create([
                'store_id' => $product['store_id'],
                'product_category_id' => $product['product_category_id'],
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'short_description' => $product['short_description'],
                'description' => $product['description'],
                'condition' => $product['condition'],
                'price' => $product['price'],
                'weight' => $product['weight'],
                'stock' => $product['stock'],
            ]);

            ProductImage::create([
                'product_id' => $newProduct->id,
                'image' => $product['image'],
                'is_thumbnail' => true,
            ]);
        }
    }
}