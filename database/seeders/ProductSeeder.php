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
            // DION'S STORE (store_id = 1) - Mixed Categories
            [
                'store_id' => 1,
                'product_category_id' => 1, // Outerwear
                'name' => 'DK Legacy Varsity Jacket',
                'short_description' => 'Premium Wool Varsity',
                'short_description_id' => 'Jaket Varsity Premium',
                'description' => 'Crafted with a premium wool body and vegan leather sleeves, featuring chenille embroidery for a timeless collegiate look.',
                'description_id' => 'Dibuat dengan bahan wol premium dan lengan kulit vegan, dilengkapi bordir chenille untuk tampilan collegiate yang timeless.',
                'condition' => 'new',
                'price' => 1899000,
                'weight' => 800,
                'stock' => 25,
                'image' => 'images/products/outerwear/dk-legacy-varsity.jpg',
            ],
            [
                'store_id' => 1,
                'product_category_id' => 1, // Outerwear
                'name' => 'Midnight Rider Leather Jacket',
                'short_description' => 'Vintage Biker Leather',
                'short_description_id' => 'Jaket Kulit Biker Vintage',
                'description' => 'A rebellious biker silhouette with a vintage brown finish and heavy-duty hardware for the ultimate night rider aesthetic.',
                'description_id' => 'Siluet biker yang rebellious dengan finishing coklat vintage dan hardware heavy-duty untuk estetika night rider yang ultimate.',
                'condition' => 'new',
                'price' => 2499000,
                'weight' => 1200,
                'stock' => 15,
                'image' => 'images/products/outerwear/midnight-rider-leather.jpg',
            ],
            [
                'store_id' => 1,
                'product_category_id' => 2, // T-Shirts
                'name' => 'DK Legacy Cherub Tee',
                'short_description' => 'Oversized Cherub Tee',
                'short_description_id' => 'Kaos Cherub Oversized',
                'description' => 'Oversized fit in vintage cream, highlighting a Renaissance-inspired cherub graphic with signature script branding.',
                'description_id' => 'Potongan oversized dalam warna cream vintage, menampilkan grafis cherub terinspirasi Renaissance dengan branding script khas.',
                'condition' => 'new',
                'price' => 599000,
                'weight' => 300,
                'stock' => 50,
                'image' => 'images/products/tshirts/dk-legacy-cherub.jpg',
            ],
            [
                'store_id' => 1,
                'product_category_id' => 3, // Bottoms
                'name' => 'DK Brutalist Concrete Tech-Pants',
                'short_description' => 'Concrete Tech Trousers',
                'short_description_id' => 'Celana Tech Concrete',
                'description' => 'Futuristic technical trousers featuring a unique concrete-wash texture and structural knee panels for an industrial look.',
                'description_id' => 'Celana teknis futuristik dengan tekstur concrete-wash unik dan panel lutut struktural untuk tampilan industrial.',
                'condition' => 'new',
                'price' => 1299000,
                'weight' => 600,
                'stock' => 30,
                'image' => 'images/products/bottoms/brutalist-concrete.jpg',
            ],
            [
                'store_id' => 1,
                'product_category_id' => 3, // Bottoms
                'name' => 'Wasteland Grunge Cargo',
                'short_description' => 'Shadow Camo Cargo',
                'short_description_id' => 'Cargo Camo Gelap',
                'description' => 'Utility-focused cargo pants with a dark shadow-camo print and multiple pockets, built for the post-apocalyptic trend.',
                'description_id' => 'Celana cargo fokus utilitas dengan print shadow-camo gelap dan banyak kantong, dibuat untuk tren post-apocalyptic.',
                'condition' => 'new',
                'price' => 1199000,
                'weight' => 650,
                'stock' => 35,
                'image' => 'images/products/bottoms/wasteland-cargo.jpg',
            ],
            [
                'store_id' => 1,
                'product_category_id' => 5, // Footwear
                'name' => 'The Maroon Chunky Sneaker',
                'short_description' => 'Urban Chunky Sneaker',
                'short_description_id' => 'Sneaker Tebal Urban',
                'description' => 'Thick sneakers with modern urban design, comfortable for all-day wear with premium materials and bold maroon colorway.',
                'description_id' => 'Sneaker tebal dengan desain urban yang modern dan nyaman dipakai seharian.',
                'condition' => 'new',
                'price' => 1599000,
                'weight' => 1000,
                'stock' => 20,
                'image' => 'images/products/footwear/shoes1.png',
            ],
            [
                'store_id' => 1,
                'product_category_id' => 5, // Footwear
                'name' => 'The Tan Leather Boot',
                'short_description' => 'Premium Leather Boot',
                'short_description_id' => 'Bot Kulit Premium',
                'description' => 'High-top leather boots with elegant appearance and premium synthetic leather materials for sophisticated style.',
                'description_id' => 'Sepatu bot kulit tinggi dengan tampilan elegan dan material kulit sintetis premium.',
                'condition' => 'new',
                'price' => 2199000,
                'weight' => 1200,
                'stock' => 15,
                'image' => 'images/products/footwear/shoes2.png',
            ],
            [
                'store_id' => 1,
                'product_category_id' => 4, // Accessories
                'name' => 'DK Owners Club Varsity Cap',
                'short_description' => 'Owners Club Cap',
                'short_description_id' => 'Topi Owners Club',
                'description' => 'Classic cream dad hat featuring bold "Owners Club" embroidery, marking your entry into the exclusive DK community.',
                'description_id' => 'Topi dad hat cream klasik dengan bordir "Owners Club" yang bold, menandai masukmu ke komunitas eksklusif DK.',
                'condition' => 'new',
                'price' => 399000,
                'weight' => 150,
                'stock' => 60,
                'image' => 'images/products/accessories/owners-club-cap.jpg',
            ],

            // KHEIZA'S STORE (store_id = 2) - Mixed Categories
            [
                'store_id' => 2,
                'product_category_id' => 1, // Outerwear
                'name' => 'Urban Ops Bomber Hoodie',
                'short_description' => 'Tactical Hybrid Bomber',
                'short_description_id' => 'Bomber Taktis Hybrid',
                'description' => 'Hybrid tactical bomber featuring a built-in jersey hood and utility pockets, designed for modern urban exploration.',
                'description_id' => 'Bomber taktis hybrid dengan hood jersey built-in dan kantong utilitas, dirancang untuk eksplorasi urban modern.',
                'condition' => 'new',
                'price' => 1599000,
                'weight' => 700,
                'stock' => 30,
                'image' => 'images/products/outerwear/urban-ops-bomber.jpg',
            ],
            [
                'store_id' => 2,
                'product_category_id' => 2, // T-Shirts
                'name' => 'Renaissance Washed Tee',
                'short_description' => 'Gothic Washed Tee',
                'short_description_id' => 'Kaos Gothic Washed',
                'description' => 'Heavyweight cotton with a gothic-style graphic and acid-washed finish, delivering a perfect grunge aesthetic.',
                'description_id' => 'Katun heavyweight dengan grafis bergaya gothic dan finishing acid-washed, memberikan estetika grunge yang sempurna.',
                'condition' => 'new',
                'price' => 599000,
                'weight' => 300,
                'stock' => 45,
                'image' => 'images/products/tshirts/renaissance-washed.jpg',
            ],
            [
                'store_id' => 2,
                'product_category_id' => 3, // Bottoms
                'name' => 'DK Obsidian Panel Leather Pants',
                'short_description' => 'Panel Leather Pants',
                'short_description_id' => 'Celana Kulit Panel',
                'description' => 'Sleek faux leather trousers with architectural knee panels, offering a sharp and edgy silhouette for evening wear.',
                'description_id' => 'Celana kulit faux yang sleek dengan panel lutut arsitektural, menawarkan siluet tajam dan edgy untuk evening wear.',
                'condition' => 'new',
                'price' => 1799000,
                'weight' => 700,
                'stock' => 20,
                'image' => 'images/products/bottoms/obsidian-panel.jpg',
            ],
            [
                'store_id' => 2,
                'product_category_id' => 5, // Footwear
                'name' => 'The Brown Cut-Out Heel',
                'short_description' => 'Modern Cut-Out Heel',
                'short_description_id' => 'Hak Desain Modern',
                'description' => 'Heel shoes with unique cut-out design, giving a modern and stylish impression for contemporary fashion.',
                'description_id' => 'Sepatu hak dengan desain cut-out yang unik, memberikan kesan modern dan stylish.',
                'condition' => 'new',
                'price' => 1899000,
                'weight' => 800,
                'stock' => 18,
                'image' => 'images/products/footwear/shoes3.png',
            ],
            [
                'store_id' => 2,
                'product_category_id' => 5, // Footwear
                'name' => 'The Pink Chunky Sneaker',
                'short_description' => 'Pink Statement Sneaker',
                'short_description_id' => 'Sneaker Pink Statement',
                'description' => 'Pink chunky sneakers that become a statement piece for your casual style with bold color and comfortable fit.',
                'description_id' => 'Sneaker chunky warna pink yang menjadi statement piece untuk gaya kasualmu.',
                'condition' => 'new',
                'price' => 1299000,
                'weight' => 950,
                'stock' => 25,
                'image' => 'images/products/footwear/shoes4.png',
            ],
            [
                'store_id' => 2,
                'product_category_id' => 4, // Accessories
                'name' => 'DK Shadow Camo Beanie',
                'short_description' => 'Dark Camo Beanie',
                'short_description_id' => 'Beanie Camo Gelap',
                'description' => 'Ribbed knit beanie in a subtle dark camouflage pattern, providing essential warmth with a tactical edge.',
                'description_id' => 'Beanie rajut ribbed dengan pola kamuflase gelap yang subtle, memberikan kehangatan esensial dengan sentuhan taktis.',
                'condition' => 'new',
                'price' => 299000,
                'weight' => 100,
                'stock' => 70,
                'image' => 'images/products/accessories/shadow-camo-beanie.jpg',
            ],
            [
                'store_id' => 2,
                'product_category_id' => 4, // Accessories
                'name' => 'Rebel Silver Wallet Chain',
                'short_description' => 'Gothic Wallet Chain',
                'short_description_id' => 'Rantai Dompet Gothic',
                'description' => 'Heavy-duty silver chain with intricate gothic links, the perfect finishing accessory for your denim or leather pants.',
                'description_id' => 'Rantai silver heavy-duty dengan link gothic yang rumit, aksesori finishing sempurna untuk celana denim atau kulit.',
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
                'short_description_id' => $product['short_description_id'],
                'description' => $product['description'],
                'description_id' => $product['description_id'],
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