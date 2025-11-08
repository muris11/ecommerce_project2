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
    // Decode URL
    $decoded = urldecode($path);
    
    // Base directory yang aman
    $baseDir = storage_path('app/public/products');
    
    // Path lengkap yang diminta
    $requestedPath = $baseDir . DIRECTORY_SEPARATOR . $decoded;
    
    // Normalisasi path untuk mencegah path traversal
    $realPath = realpath($requestedPath);
    $realBase = realpath($baseDir);
    
    // Validasi: path harus ada dan berada di dalam base directory
    if (!$realPath || !$realBase || strpos($realPath, $realBase) !== 0) {
        Log::warning("[SECURITY] Path traversal attempt blocked: $decoded");
        abort(403, 'Access denied');
    }
    
    // Validasi: file harus exist
    if (!file_exists($realPath) || !is_file($realPath)) {
        Log::warning("[IMG404] File not found: $realPath (req: $path)");
        abort(404, 'File not found');
    }
    
    // Validasi: hanya izinkan file gambar
    $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];
    $mime = mime_content_type($realPath);
    
    if (!in_array($mime, $allowedMimes)) {
        Log::warning("[SECURITY] Invalid file type blocked: $mime for $decoded");
        abort(403, 'Invalid file type');
    }
    
    return response()->file($realPath, [
        'Content-Type' => $mime,
        'Cache-Control' => 'public, max-age=31536000',
    ]);
})->where('path', '.*');

// ================== Public Routes ==================
Route::get('/', HomePage::class)->name('home');
Route::get('/categories', CategoriesPage::class)->name('categories');
Route::get('/products', ProductsPage::class)->name('products');
Route::get('/products/{product:slug}', ProductDetailPage::class)->name('products.show');
Route::get('/products/{product:slug}/reviews', \App\Livewire\ProductReviewsPage::class)->name('product.reviews');
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
    // SECURITY: Changed to POST to prevent CSRF logout attacks
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');

    Route::get('/checkout', CheckoutPage::class)->name('checkout');

    Route::get('/profile', \App\Livewire\ProfilePage::class)->name('profile');
    Route::get('/my-orders', MyOrdersPage::class)->name('my-orders');
    Route::get('/my-orders/{order}', MyOrderDetailPage::class)->name('my-orders.show');

    Route::get('/payment/midtrans/{order}', MidtransPaymentPage::class)->name('payment.midtrans');

    Route::get('/success', SuccessPage::class)->name('success');
    Route::get('/cancel', CancelPage::class)->name('cancel');
});

// ================== Admin Routes (Separate from Filament) ==================
// Note: Filament admin panel is available at /admin
// These routes are for additional admin functionality if needed

// ================== API Routes (Versioned) ==================
// All API routes are now versioned in routes/api.php

// Midtrans callback routes (no auth needed)
Route::post('/midtrans/callback', [MidtransController::class, 'callback'])->name('midtrans.callback');
Route::get('/midtrans/finish', [MidtransController::class, 'finish'])->name('midtrans.finish');
Route::get('/midtrans/unfinish', [MidtransController::class, 'unfinish'])->name('midtrans.unfinish');
Route::get('/midtrans/error', [MidtransController::class, 'error'])->name('midtrans.error');



