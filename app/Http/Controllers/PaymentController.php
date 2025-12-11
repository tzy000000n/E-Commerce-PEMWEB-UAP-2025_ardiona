<?php

namespace App\Http\Controllers;

use App\Models\VirtualAccount;
use App\Models\UserBalance;
use App\Models\StoreBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment.index');
    }

    public function check(Request $request)
    {
        $request->validate([
            'va_number' => 'required|string',
        ]);

        return redirect()->route('payment.show_confirm', ['va_number' => $request->va_number]);
    }

    public function showConfirm($va_number)
    {
        $virtualAccount = VirtualAccount::with(['user', 'transaction'])
            ->where('va_number', $va_number)
            ->where('user_id', auth()->id())
            ->first();

        if (!$virtualAccount) {
            return redirect()->route('payment.index')->with('error', 'Kode VA tidak ditemukan atau bukan milik Anda');
        }

        if ($virtualAccount->status === 'paid') {
            return redirect()->route('payment.index')->with('error', 'VA ini sudah dibayar');
        }

        if ($virtualAccount->expired_at < now()) {
            return redirect()->route('payment.index')->with('error', 'VA ini sudah kadaluarsa');
        }

        return view('payment.confirm', compact('virtualAccount'));
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'va_number' => 'required|exists:virtual_accounts,va_number',
            'amount' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $va = VirtualAccount::with(['transaction.transactionDetails.product.store'])
                ->where('va_number', $request->va_number)
                ->where('user_id', auth()->id())
                ->firstOrFail();

            if ($va->status === 'paid') {
                return back()->with('error', 'VA ini sudah dibayar');
            }

            if ($va->expired_at < now()) {
                $va->update(['status' => 'expired']);
                return back()->with('error', 'VA ini sudah kadaluarsa');
            }

            if ($request->amount < $va->amount) {
                return back()->with('error', 'Jumlah pembayaran kurang dari yang seharusnya');
            }

            // Update status VA
            $va->update(['status' => 'paid']);

            if ($va->type === 'topup') {
                // Topup saldo user
                $userBalance = UserBalance::firstOrCreate(
                    ['user_id' => $va->user_id],
                    ['balance' => 0]
                );
                $userBalance->increment('balance', (float) $va->amount);

                DB::commit();
                return redirect()->route('wallet.topup')->with('success', 'Topup berhasil! Saldo Anda bertambah Rp ' . number_format($va->amount, 0, ',', '.'));
            } else {
                // Pembayaran transaksi
                $transaction = $va->transaction;
                $transaction->update(['payment_status' => 'paid']);

                // Kurangi stok produk
                foreach ($transaction->transactionDetails as $detail) {
                    $detail->product->decrement('stock', $detail->qty);
                }

                // Tambah saldo toko
                $storeBalance = StoreBalance::firstOrCreate(
                    ['store_id' => $transaction->store_id],
                    ['balance' => 0]
                );
                $storeBalance->increment('balance', $transaction->grand_total);

                DB::commit();
                return redirect()->route('history.show', $transaction->id)->with('success', 'Pembayaran berhasil!');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
