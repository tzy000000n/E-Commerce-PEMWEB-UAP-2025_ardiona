<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\StoreBalance;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WithdrawalController extends Controller
{
    public function index()
    {
        $store = auth()->user()->store;
        $storeBalance = StoreBalance::firstOrCreate(
            ['store_id' => $store->id],
            ['balance' => 0]
        );
        
        $withdrawals = Withdrawal::where('store_balance_id', $storeBalance->id)
            ->latest()
            ->paginate(10);
        
        return view('seller.withdrawals.index', compact('storeBalance', 'withdrawals'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:50000',
            'bank_account_name' => 'required|string',
            'bank_account_number' => 'required|string',
            'bank_name' => 'required|string',
        ]);
        
        $store = auth()->user()->store;
        $storeBalance = StoreBalance::where('store_id', $store->id)->firstOrFail();
        
        if ($storeBalance->balance < $request->amount) {
            return back()->with('error', 'Saldo tidak mencukupi');
        }
        
        DB::beginTransaction();
        try {
            // Buat withdrawal request
            Withdrawal::create([
                'store_balance_id' => $storeBalance->id,
                'amount' => $request->amount,
                'bank_account_name' => $request->bank_account_name,
                'bank_account_number' => $request->bank_account_number,
                'bank_name' => $request->bank_name,
                'status' => 'pending',
            ]);
            
            // Kurangi saldo (hold)
            $storeBalance->decrement('balance', $request->amount);
            
            DB::commit();
            return back()->with('success', 'Permintaan penarikan dana berhasil diajukan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
