<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransController;

use App\Livewire\HomePage;
use App\Livewire\CartPage;
use App\Livewire\BrandsPage;
use App\Livewire\CancelPage;
use App\Livewire\SuccessPage;
use App\Livewire\CheckoutPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\ProductsPage;
use App\Livewire\CategoriesPage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\Auth\ForgotPasswordPage;
use App\Livewire\MidtransPaymentPage;

// routes/web.php
use Illuminate\Support\Facades\Log;

Route::get('/storage/products/{path}', function (string $path) {
    // Normalisasi & decode agar "spasi" / karakter aneh aman
    $decoded = urldecode($path);

    $full = storage_path('products/' . $decoded);
    if (!file_exists($full)) {
        Log::warning("[IMG404] File not found: $full (req: $path)");
        abort(404, 'File not found');
    }

    // Tentukan MIME (fallback image/jpeg bila gagal)
    $mime = @mime_content_type($full) ?: 'image/jpeg';
    return response()->file($full, ['Content-Type' => $mime]);
})->where('path', '.*');

// ================== Public Routes ==================
Route::get('/', HomePage::class)->name('home');
Route::get('/categories', CategoriesPage::class)->name('categories');
Route::get('/products', ProductsPage::class)->name('products');
Route::get('/products/{slug}', ProductDetailPage::class)->name('products.show');
Route::get('/products/{slug}/reviews', \App\Livewire\ProductReviewsPage::class)->name('product.reviews');
Route::get('/brands', BrandsPage::class)->name('brands');
Route::get('/cart', CartPage::class)->name('cart');
Route::get('/penilaian-pelanggan', \App\Livewire\StoreReviewsPage::class)->name('store.reviews');
Route::get('/about', \App\Livewire\AboutPage::class)->name('about');
Route::get('/contact', \App\Livewire\ContactPage::class)->name('contact');

// ================== Guest Only ==================
Route::middleware('guest')->group(function () {
    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/register', RegisterPage::class)->name('register');
    Route::get('/forgot', ForgotPasswordPage::class)->name('password.request');
    Route::get('/reset/{token}', ResetPasswordPage::class)->name('password.reset');
});

// ================== Authenticated Only ==================
Route::middleware('auth')->group(function () {
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    });

    Route::get('/checkout', CheckoutPage::class)->name('checkout');

    Route::get('/profile', \App\Livewire\ProfilePage::class)->name('profile');
    Route::get('/my-orders', MyOrdersPage::class)->name('my-orders');
    Route::get('/my-orders/{order_id}', MyOrderDetailPage::class)->name('my-orders.show');

    Route::get('/payment/midtrans/{order}', MidtransPaymentPage::class)->name('payment.midtrans');

    Route::get('/success', SuccessPage::class)->name('success');
    Route::get('/cancel', CancelPage::class)->name('cancel');
});

// Midtrans callback routes (no auth needed)
Route::post('/midtrans/callback', [MidtransController::class, 'callback'])->name('midtrans.callback');
Route::get('/midtrans/finish', [MidtransController::class, 'finish'])->name('midtrans.finish');
Route::get('/midtrans/unfinish', [MidtransController::class, 'unfinish'])->name('midtrans.unfinish');
Route::get('/midtrans/error', [MidtransController::class, 'error'])->name('midtrans.error');



