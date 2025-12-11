<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreBalance;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::with('storeBalance.store')
            ->latest()
            ->paginate(10);

        return view('admin.withdrawals.index', compact('withdrawals'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $withdrawal = Withdrawal::with('storeBalance')->findOrFail($id);

        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'Withdrawal request already processed.');
        }

        DB::transaction(function () use ($withdrawal, $request) {
            $withdrawal->status = $request->status;
            $withdrawal->save();

            if ($request->status === 'rejected') {
                // Refund balance to store
                $storeBalance = $withdrawal->storeBalance;
                if ($storeBalance) {
                    $storeBalance->increment('balance', $withdrawal->amount);
                }
            }
        });

        return back()->with('success', 'Withdrawal status updated successfully.');
    }
}
