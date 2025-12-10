<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Transaction::with(['user', 'transactionDetails.product'])
            ->where('store_id', auth()->user()->store->id)
            ->latest()
            ->paginate(10);
        
        return view('seller.orders.index', compact('orders'));
    }
    
    public function show($id)
    {
        $order = Transaction::with(['user', 'transactionDetails.product'])
            ->where('store_id', auth()->user()->store->id)
            ->findOrFail($id);
        
        return view('seller.orders.show', compact('order'));
    }
    
    public function update(Request $request, $id)
    {
        $order = Transaction::where('store_id', auth()->user()->store->id)->findOrFail($id);
        
        $request->validate([
            'tracking_number' => 'nullable|string',
        ]);
        
        $order->update([
            'tracking_number' => $request->tracking_number,
        ]);
        
        return back()->with('success', 'Nomor resi berhasil diperbarui');
    }
}
