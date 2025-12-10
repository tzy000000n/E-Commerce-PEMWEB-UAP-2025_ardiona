<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Customer\ProductController as CustomerProductController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\TransactionController;
use App\Http\Controllers\Customer\WalletController;
use App\Http\Controllers\Seller\StoreController;
use App\Http\Controllers\Seller\ProductController as SellerProductController;
use App\Http\Controllers\Seller\CategoryController;
use App\Http\Controllers\Seller\OrderController;
use App\Http\Controllers\Seller\BalanceController;
use App\Http\Controllers\Seller\WithdrawalController;
use App\Http\Controllers\Admin\StoreVerificationController;
use App\Http\Controllers\Admin\UserManagementController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [\App\Http\Controllers\ShopController::class, 'index'])->name('shop');
Route::get('/product/{slug}', [CustomerProductController::class, 'show'])->name('product.show');

// Language Switcher
Route::get('/language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return redirect()->back();
})->name('language.switch');

// Payment Routes (untuk semua user yang login)
Route::middleware('auth')->group(function () {
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment/check', [PaymentController::class, 'check'])->name('payment.check');
    Route::post('/payment/confirm', [PaymentController::class, 'confirm'])->name('payment.confirm');
});

// Customer/Member Routes
Route::middleware(['auth', 'member'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/history', [TransactionController::class, 'index'])->name('history.index');
    Route::get('/history/{id}', [TransactionController::class, 'show'])->name('history.show');
    Route::get('/wallet/topup', [WalletController::class, 'topup'])->name('wallet.topup');
    Route::post('/wallet/topup', [WalletController::class, 'storeTopup'])->name('wallet.topup.store');
});

// Store Registration (untuk member yang belum punya toko)
Route::middleware(['auth', 'member'])->group(function () {
    Route::get('/store/register', [StoreController::class, 'create'])->name('store.register');
    Route::post('/store/register', [StoreController::class, 'store'])->name('store.store');
});

// Seller Routes (member yang sudah punya toko)
Route::middleware(['auth', 'seller'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('/profile', [StoreController::class, 'edit'])->name('profile');
    Route::put('/profile', [StoreController::class, 'update'])->name('profile.update');
    
    Route::resource('categories', CategoryController::class);
    Route::resource('products', SellerProductController::class);
    
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
    
    Route::get('/balance', [BalanceController::class, 'index'])->name('balance.index');
    
    Route::get('/withdrawals', [WithdrawalController::class, 'index'])->name('withdrawals.index');
    Route::post('/withdrawals', [WithdrawalController::class, 'store'])->name('withdrawals.store');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/verification', [StoreVerificationController::class, 'index'])->name('verification.index');
    Route::post('/verification/{id}/approve', [StoreVerificationController::class, 'approve'])->name('verification.approve');
    Route::post('/verification/{id}/reject', [StoreVerificationController::class, 'reject'])->name('verification.reject');
    
    Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
    Route::get('/stores', [UserManagementController::class, 'stores'])->name('stores.index');
});

Route::get('/dashboard', function () {
    return redirect()->route('home')->with('success', 'Selamat datang, ' . auth()->user()->name . '! Anda berhasil login.');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
