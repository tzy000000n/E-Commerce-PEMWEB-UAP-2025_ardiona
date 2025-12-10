<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['store', 'transactionDetails.product'])
            ->where('buyer_id', auth()->id())
            ->latest()
            ->paginate(10);
        
        return view('customer.history', compact('transactions'));
    }
    
    public function show($id)
    {
        $transaction = Transaction::with(['store', 'transactionDetails.product'])
            ->where('buyer_id', auth()->id())
            ->findOrFail($id);
        
        return view('customer.history-detail', compact('transaction'));
    }
}
