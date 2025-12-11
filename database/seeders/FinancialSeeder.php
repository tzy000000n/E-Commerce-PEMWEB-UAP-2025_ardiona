<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\StoreBalance;
use App\Models\Withdrawal;
use App\Models\Transaction;
use App\Models\StoreBalanceHistory;
use Illuminate\Database\Seeder;

class FinancialSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Setup Balances & Withdrawals for Dion (Store 1)
        $store1 = Store::find(1);
        if ($store1) {
            $balance1 = StoreBalance::create([
                'store_id' => $store1->id,
                'balance' => 8500000, // Sisa saldo
            ]);

            // History Income
            StoreBalanceHistory::create([
                'store_balance_id' => $balance1->id,
                'type' => 'income',
                'reference_id' => \Illuminate\Support\Str::uuid(),
                'reference_type' => 'transaction',
                'amount' => 10000000,
                'remarks' => 'Penjualan Batch 1'
            ]);

            // Withdrawal 1 (Approved)
            Withdrawal::create([
                'store_balance_id' => $balance1->id,
                'amount' => 1000000,
                'bank_name' => 'BCA',
                'bank_account_name' => 'Dion Owner',
                'bank_account_number' => '1234567890',
                'status' => 'approved',
                'created_at' => now()->subDays(5),
            ]);
            
            // Withdrawal 2 (Pending)
            Withdrawal::create([
                'store_balance_id' => $balance1->id,
                'amount' => 500000,
                'bank_name' => 'BCA',
                'bank_account_name' => 'Dion Owner',
                'bank_account_number' => '1234567890',
                'status' => 'pending',
                'created_at' => now()->subDay(),
            ]);
        }

        // 2. Setup Balances & Withdrawals for Kheiza (Store 2)
        $store2 = Store::find(2);
        if ($store2) {
            $balance2 = StoreBalance::create([
                'store_id' => $store2->id,
                'balance' => 12000000,
            ]);

             // History Income
             StoreBalanceHistory::create([
                'store_balance_id' => $balance2->id,
                'type' => 'income',
                'reference_id' => \Illuminate\Support\Str::uuid(),
                'reference_type' => 'transaction',
                'amount' => 15000000,
                'remarks' => 'Penjualan Awal Tahun'
            ]);

            // Withdrawal 1 (Rejected - Refunded)
            Withdrawal::create([
                'store_balance_id' => $balance2->id,
                'amount' => 2000000,
                'bank_name' => 'Mandiri',
                'bank_account_name' => 'Kheiza Owner',
                'bank_account_number' => '0987654321',
                'status' => 'rejected',
                'created_at' => now()->subDays(3),
            ]);

            // Withdrawal 2 (Approved)
            Withdrawal::create([
                'store_balance_id' => $balance2->id,
                'amount' => 1000000,
                'bank_name' => 'Mandiri',
                'bank_account_name' => 'Kheiza Owner',
                'bank_account_number' => '0987654321',
                'status' => 'approved',
                'created_at' => now()->subDays(1),
            ]);
        }
    }
}
