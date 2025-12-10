<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        // Toko milik user_id 2 (Dion)
        Store::create([
            'user_id' => 2,
            'name' => 'DK Supply Co. - Dion Store',
            'logo' => 'images/stores/dion-store.png',
            'about' => 'Premium streetwear collection by Dion - Co-founder of DK Supply Co.',
            'phone' => '081234567891',
            'address_id' => 'JKT001',
            'city' => 'Jakarta',
            'address' => 'Jl. Kemang Raya No. 45, Jakarta Selatan',
            'postal_code' => '12560',
            'is_verified' => true,
        ]);

        // Toko milik user_id 3 (Kheiza)
        Store::create([
            'user_id' => 3,
            'name' => 'DK Supply Co. - Kheiza Store',
            'logo' => 'images/stores/kheiza-store.png',
            'about' => 'Premium streetwear collection by Kheiza - Co-founder of DK Supply Co.',
            'phone' => '081234567892',
            'address_id' => 'JKT002',
            'city' => 'Jakarta',
            'address' => 'Jl. Senopati No. 78, Jakarta Selatan',
            'postal_code' => '12190',
            'is_verified' => true,
        ]);
    }
}
