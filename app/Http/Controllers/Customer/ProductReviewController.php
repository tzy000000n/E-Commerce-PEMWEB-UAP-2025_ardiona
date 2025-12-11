<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'transaction_detail_id' => 'required|exists:transaction_details,id',
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|min:5',
        ]);

        // Verifikasi bahwa user benar-benar membeli produk ini
        $detail = TransactionDetail::with('transaction')
            ->findOrFail($request->transaction_detail_id);

        if ($detail->transaction->buyer_id !== auth()->id()) {
            return back()->with('error', 'Anda tidak memiliki hak untuk mereview transaksi ini.');
        }

        if ($detail->product_id != $request->product_id) {
            return back()->with('error', 'Produk tidak cocok dengan data transaksi.');
        }

        // Cek apakah sudah pernah review
        $existingReview = ProductReview::where('transaction_id', $detail->transaction_id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingReview) {
            return back()->with('error', 'Anda sudah memberikan review untuk produk ini.');
        }

        ProductReview::create([
            'transaction_id' => $detail->transaction_id,
            'product_id' => $request->product_id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return back()->with('success', 'Terima kasih atas review Anda!');
    }
}
