<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\UserBalance;
use App\Models\VirtualAccount;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function topup()
    {
        $userBalance = UserBalance::firstOrCreate(
            ['user_id' => auth()->id()],
            ['balance' => 0]
        );
        
        return view('customer.wallet-topup', compact('userBalance'));
    }
    
    public function storeTopup(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000',
        ]);
        
        // Buat Virtual Account untuk topup
        $va = VirtualAccount::create([
            'va_number' => VirtualAccount::generateVANumber(),
            'user_id' => auth()->id(),
            'type' => 'topup',
            'amount' => $request->amount,
            'status' => 'pending',
            'expired_at' => now()->addHours(24),
        ]);
        
        return redirect()->route('payment.index', ['va_number' => $va->va_number])
            ->with('success', 'Virtual Account berhasil dibuat! Silakan lakukan pembayaran.');
    }
}
