<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function create()
    {
        // Cek apakah user sudah punya toko
        if (auth()->user()->store) {
            return redirect()->route('home')->with('info', 'Anda sudah memiliki toko');
        }

        return view('seller.store-register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'about' => 'required|string',
            'phone' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'postal_code' => 'required|string',
        ]);

        $logoPath = 'https://via.placeholder.com/200x200.png?text=Store';

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('stores', 'public');
            $logoPath = Storage::url($logoPath);
        }

        $store = Store::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'logo' => $logoPath,
            'about' => $request->about,
            'phone' => $request->phone,
            'address_id' => 'ADDR' . rand(1000, 9999),
            'city' => $request->city,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'is_verified' => false,
        ]);

        // Buat store balance
        \App\Models\StoreBalance::create([
            'store_id' => $store->id,
            'balance' => 0
        ]);

        return redirect()->route('home')->with('success', 'Toko berhasil didaftarkan! Menunggu verifikasi admin.');
    }

    public function edit()
    {
        $store = auth()->user()->store;

        if (!$store) {
            return redirect()->route('store.register');
        }

        return view('seller.store-profile', compact('store'));
    }

    public function update(Request $request)
    {
        $store = auth()->user()->store;

        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'about' => 'required|string',
            'phone' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'postal_code' => 'required|string',
            'bank_name' => 'nullable|string',
            'bank_account_number' => 'nullable|string',
            'bank_account_name' => 'nullable|string',
        ]);

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('stores', 'public');
            $data['logo'] = Storage::url($logoPath);
        }

        $store->update($data);

        return back()->with('success', 'Profil toko berhasil diperbarui');
    }

    public function destroy()
    {
        $store = auth()->user()->store;

        if ($store) {
            // Optional: Check if there are active transactions before deleting
            $hasPendingOrders = $store->transactions()
                ->whereIn('payment_status', ['paid'])
                ->where('shipping_status', '!=', 'completed')
                ->exists();

            if ($hasPendingOrders) {
                return back()->with('error', 'Tidak dapat menghapus toko karena masih ada pesanan aktif.');
            }

            $store->delete();
        }

        return redirect()->route('home')->with('success', 'Toko berhasil dihapus.');
    }
}
