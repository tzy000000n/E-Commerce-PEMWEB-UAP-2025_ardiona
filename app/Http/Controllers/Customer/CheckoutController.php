<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\VirtualAccount;
use App\Models\UserBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // Check if user is admin or seller - they cannot buy products
        if (auth()->user()->role === 'admin') {
            return redirect()->route('home')->with('error', 'Admin tidak dapat membeli produk. Silakan gunakan akun customer.');
        }

        if (auth()->user()->store) {
            return redirect()->route('home')->with('error', 'Seller tidak dapat membeli produk. Silakan gunakan akun customer.');
        }

        // Ambil data produk dari session atau request
        $productId = $request->product_id;
        $qty = $request->qty ?? 1;

        if (!$productId) {
            return redirect()->route('home')->with('error', 'Produk tidak ditemukan');
        }

        $product = Product::with('store')->findOrFail($productId);

        if ($product->stock < $qty) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi');
        }

        $subtotal = $product->price * $qty;
        $shippingCost = 15000; // Default shipping
        $tax = $subtotal * 0.11; // PPN 11%
        $grandTotal = $subtotal + $shippingCost + $tax;

        $userBalance = UserBalance::where('user_id', auth()->id())->first();

        return view('customer.checkout', compact('product', 'qty', 'subtotal', 'shippingCost', 'tax', 'grandTotal', 'userBalance'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'shipping_type' => 'required|string',
            'payment_method' => 'required|in:wallet,va',
        ]);

        DB::beginTransaction();
        try {
            $product = Product::findOrFail($request->product_id);

            if ($product->stock < $request->qty) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi');
            }

            $subtotal = $product->price * $request->qty;
            $shippingCost = $this->calculateShipping($request->shipping_type);
            $tax = $subtotal * 0.11;
            $grandTotal = $subtotal + $shippingCost + $tax;

            // Buat transaksi
            $transaction = Transaction::create([
                'code' => 'TRX' . now()->format('YmdHis') . rand(1000, 9999),
                'buyer_id' => auth()->id(),
                'store_id' => $product->store_id,
                'address' => $request->address,
                'address_id' => 'ADDR' . rand(1000, 9999),
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'shipping' => 'JNE',
                'shipping_type' => $request->shipping_type,
                'shipping_cost' => $shippingCost,
                'tax' => $tax,
                'grand_total' => $grandTotal,
                'payment_status' => 'unpaid',
            ]);

            // Buat detail transaksi
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $product->id,
                'qty' => $request->qty,
                'subtotal' => $subtotal,
            ]);

            // Proses pembayaran
            if ($request->payment_method === 'wallet') {
                $userBalance = UserBalance::firstOrCreate(
                    ['user_id' => auth()->id()],
                    ['balance' => 0]
                );

                if ($userBalance->balance < $grandTotal) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Saldo tidak mencukupi');
                }

                // Kurangi saldo
                $userBalance->decrement('balance', $grandTotal);

                // Update status pembayaran
                $transaction->update(['payment_status' => 'paid']);

                // Kurangi stok
                $product->decrement('stock', $request->qty);

                // Tambah saldo toko
                $storeBalance = \App\Models\StoreBalance::firstOrCreate(
                    ['store_id' => $product->store_id],
                    ['balance' => 0]
                );
                $storeBalance->increment('balance', $grandTotal);

                DB::commit();
                return redirect()->route('history.show', $transaction->id)->with('success', 'Pembayaran berhasil!');
            } else {
                // Buat Virtual Account
                $va = VirtualAccount::create([
                    'va_number' => VirtualAccount::generateVANumber(),
                    'user_id' => auth()->id(),
                    'transaction_id' => $transaction->id,
                    'type' => 'purchase',
                    'amount' => $grandTotal,
                    'status' => 'pending',
                    'expired_at' => now()->addHours(24),
                ]);

                DB::commit();
                return redirect()->route('payment.index')
                    ->with('success', 'Transaksi berhasil dibuat!')
                    ->with('va_number', $va->va_number)
                    ->with('va_amount', $grandTotal);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function calculateShipping($type)
    {
        return match ($type) {
            'regular' => 15000,
            'express' => 25000,
            'same_day' => 35000,
            default => 15000,
        };
    }
}
