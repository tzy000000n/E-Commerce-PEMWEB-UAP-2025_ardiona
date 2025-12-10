<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreVerificationController extends Controller
{
    public function index()
    {
        $stores = Store::with('user')
            ->where('is_verified', false)
            ->latest()
            ->paginate(10);
        
        return view('admin.verification.index', compact('stores'));
    }
    
    public function approve($id)
    {
        $store = Store::findOrFail($id);
        $store->update(['is_verified' => true]);
        
        return back()->with('success', 'Toko berhasil diverifikasi');
    }
    
    public function reject($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();
        
        return back()->with('success', 'Toko berhasil ditolak dan dihapus');
    }
}
