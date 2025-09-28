<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes

// Authentication routes
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
});

// Public product routes
Route::get('products', [ProductController::class, 'index']);
Route::get('products/{slug}', [ProductController::class, 'show']);
Route::get('products/featured', [ProductController::class, 'featured']);
Route::get('products/on-sale', [ProductController::class, 'onSale']);

// Public category routes
Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{slug}', [CategoryController::class, 'show']);
Route::get('categories/{slug}/products', [CategoryController::class, 'products']);

// Public brand routes
Route::get('brands', [BrandController::class, 'index']);
Route::get('brands/{slug}', [BrandController::class, 'show']);
Route::get('brands/{slug}/products', [BrandController::class, 'products']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth user routes
    Route::prefix('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
        Route::put('profile', [AuthController::class, 'updateProfile']);
        Route::put('password', [AuthController::class, 'updatePassword']);
    });

    // User management
    Route::prefix('user')->group(function () {
        Route::get('profile', [UserController::class, 'profile']);
        Route::put('profile', [UserController::class, 'updateProfile']);
    });

    // Cart management
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index']);
        Route::post('add', [CartController::class, 'add']);
        Route::put('update/{productId}', [CartController::class, 'update']);
        Route::delete('remove/{productId}', [CartController::class, 'remove']);
        Route::delete('clear', [CartController::class, 'clear']);
        Route::get('count', [CartController::class, 'count']);
        Route::get('total', [CartController::class, 'total']);
    });

    // Order management
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::post('/', [OrderController::class, 'store']);
        Route::get('{order}', [OrderController::class, 'show']);
        Route::put('{order}/cancel', [OrderController::class, 'cancel']);
        Route::get('{order}/invoice', [OrderController::class, 'invoice']);
    });

    // Admin routes (for admin users only)
    // Route::middleware('admin')->prefix('admin')->group(function () {
    //     // Product management
    //     Route::apiResource('products', ProductController::class)->except(['show']);
    //     Route::put('products/{product}/toggle-active', [ProductController::class, 'toggleActive']);
    //     Route::put('products/{product}/toggle-featured', [ProductController::class, 'toggleFeatured']);

    //     // Category management
    //     Route::apiResource('categories', CategoryController::class)->except(['show']);
    //     Route::put('categories/{category}/toggle-active', [CategoryController::class, 'toggleActive']);

    //     // Brand management
    //     Route::apiResource('brands', BrandController::class)->except(['show']);
    //     Route::put('brands/{brand}/toggle-active', [BrandController::class, 'toggleActive']);

    //     // Order management
    //     Route::get('orders', [OrderController::class, 'adminIndex']);
    //     Route::put('orders/{order}/status', [OrderController::class, 'updateStatus']);
    //     Route::put('orders/{order}/payment-status', [OrderController::class, 'updatePaymentStatus']);

    //     // User management
    //     Route::get('users', [UserController::class, 'index']);
    //     Route::get('users/{user}', [UserController::class, 'show']);
    //     Route::put('users/{user}', [UserController::class, 'update']);
    //     Route::delete('users/{user}', [UserController::class, 'destroy']);

    //     // Analytics
    //     Route::get('analytics/dashboard', [OrderController::class, 'dashboard']);
    //     Route::get('analytics/sales', [OrderController::class, 'salesAnalytics']);
    // });
});

// Route for authenticated user info
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});