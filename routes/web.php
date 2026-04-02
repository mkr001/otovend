<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;

Route::get('set-language/{lang}', function ($lang) {
    if (in_array($lang, ['pl', 'en'])) {
        session(['locale' => $lang]);
    }
    return back();
})->name('set-language');

// Public Routes
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/order/place', [OrderController::class, 'place'])->name('order.place');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // Vendor Onboarding
    Route::get('/vendor/join', [VendorController::class, 'join'])->name('vendor.join');
    Route::post('/vendor/upgrade', [VendorController::class, 'upgrade'])->name('vendor.upgrade');
    
    // Messages
    Route::get('/messages', [\App\Http\Controllers\MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{contact}/{product?}', [\App\Http\Controllers\MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{contact}', [\App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');

    // Favorites
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/{product}/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

    // Reviews
    Route::post('/reviews/{vendor}/{product?}', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');

    // Invoices
    Route::get('/orders/{order}/invoice', [\App\Http\Controllers\InvoiceController::class, 'download'])->name('invoices.download');

    // Payments
    Route::post('/stripe/checkout', [\App\Http\Controllers\StripeController::class, 'checkout'])->name('stripe.checkout');
    Route::get('/stripe/success/{order}', [\App\Http\Controllers\StripeController::class, 'success'])->name('stripe.success');
    Route::get('/stripe/cancel/{order}', [\App\Http\Controllers\StripeController::class, 'cancel'])->name('stripe.cancel');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::get('/roles', [AdminController::class, 'roles'])->name('roles');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::delete('/categories/{category}', [AdminController::class, 'destroyCategory'])->name('categories.destroy');
});

// Vendor Routes
Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    Route::get('/dashboard', [VendorController::class, 'index'])->name('dashboard');
    Route::resource('products', VendorController::class)->except(['index', 'show']); // for CRUD
    Route::get('/my-products', [VendorController::class, 'products'])->name('my-products');
    Route::get('/sales', [VendorController::class, 'sales'])->name('sales');
    Route::put('/orders/{order}/shipping', [VendorController::class, 'updateShipping'])->name('orders.shipping');
});

require __DIR__.'/auth.php';
