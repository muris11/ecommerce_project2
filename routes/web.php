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

// ================== Public Routes ==================
Route::get('/', HomePage::class);
Route::get('/categories', CategoriesPage::class);
Route::get('/products', ProductsPage::class);
Route::get('/products/{slug}', ProductDetailPage::class);
Route::get('/brands', BrandsPage::class);
Route::get('/cart', CartPage::class);

// ================== Guest Only ==================
Route::middleware('guest')->group(function () {
    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/register', RegisterPage::class);
    Route::get('/forgot', ForgotPasswordPage::class)->name('password.request');
    Route::get('/reset/{token}', ResetPasswordPage::class)->name('password.reset');
});

// ================== Authenticated Only ==================
Route::middleware('auth')->group(function () {
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    });

    Route::get('/checkout', CheckoutPage::class);

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



