<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\StoreBalance;
use App\Models\StoreBalanceHistory;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function index()
    {
        $store = auth()->user()->store;
        
        $storeBalance = StoreBalance::firstOrCreate(
            ['store_id' => $store->id],
            ['balance' => 0]
        );
        
        $histories = StoreBalanceHistory::where('store_balance_id', $storeBalance->id)
            ->latest()
            ->paginate(20);
        
        return view('seller.balance.index', compact('storeBalance', 'histories'));
    }
}
