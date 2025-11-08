<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\PasswordResetController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\StoreReviewController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AddressController;

// API Versioning - v1
Route::prefix('v1')->group(function () {

    // Public Routes
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{product:slug}', [ProductController::class, 'show']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{category:slug}', [CategoryController::class, 'show']);
    Route::get('/brands', [BrandController::class, 'index']);
    Route::get('/brands/{brand:slug}', [BrandController::class, 'show']);

    // Reviews (Public - view published reviews)
    Route::get('/reviews', [StoreReviewController::class, 'index']);
    Route::get('/reviews/{review}', [StoreReviewController::class, 'show'])->whereNumber('review');

    // Authentication Routes
    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink']);
        Route::post('/reset-password', [PasswordResetController::class, 'reset']);

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/logout', [AuthController::class, 'logout']);
            Route::get('/user', [AuthController::class, 'user']);
        });
    });

    // Cart Routes (Session-based, no auth required for basic operations)
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart', [CartController::class, 'store']);
    Route::patch('/cart/{product}', [CartController::class, 'update'])->whereNumber('product');
    Route::delete('/cart/{product}', [CartController::class, 'destroy'])->whereNumber('product');
    Route::delete('/cart', [CartController::class, 'clear']);

    // Protected Routes (Require Authentication)
    Route::middleware('auth:sanctum')->group(function () {
        // User Profile Management
        Route::get('/profile', [UserController::class, 'show']);
        Route::patch('/profile', [UserController::class, 'update']);
        Route::patch('/profile/password', [UserController::class, 'changePassword']);
        Route::post('/profile/avatar', [UserController::class, 'updateAvatar']);
        Route::delete('/profile/avatar', [UserController::class, 'deleteAvatar']);
        Route::get('/profile/statistics', [UserController::class, 'statistics']);

        // User Addresses
        Route::get('/addresses', [AddressController::class, 'index']);
        Route::get('/addresses/{address}', [AddressController::class, 'show'])->whereNumber('address');
        Route::post('/addresses', [AddressController::class, 'store']);
        Route::patch('/addresses/{address}', [AddressController::class, 'update'])->whereNumber('address');
        Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])->whereNumber('address');

        // Product Reviews
        Route::get('/products/{product:slug}/reviews', [ReviewController::class, 'index']);
        Route::post('/products/{product:slug}/reviews', [ReviewController::class, 'store']);
        Route::get('/reviews/{review}', [ReviewController::class, 'show'])->whereNumber('review');
        Route::patch('/reviews/{review}', [ReviewController::class, 'update'])->whereNumber('review');
        Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->whereNumber('review');
        Route::get('/user/reviews', [ReviewController::class, 'userReviews']);

        // Store Reviews
        Route::post('/store-reviews', [StoreReviewController::class, 'store']);
        Route::get('/user/store-reviews', [StoreReviewController::class, 'userReviews']);
        Route::patch('/store-reviews/{review}', [StoreReviewController::class, 'update'])->whereNumber('review');
        Route::delete('/store-reviews/{review}', [StoreReviewController::class, 'destroy'])->whereNumber('review');

        // Orders
        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/orders/{order}', [OrderController::class, 'show'])->whereNumber('order');

        // Checkout & Payment
        Route::post('/checkout', [CheckoutController::class, 'store']);
        Route::get('/orders/{order}/payment', [PaymentController::class, 'show'])->whereNumber('order');
    });

});
