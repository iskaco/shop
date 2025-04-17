<?php

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\CustomerController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\SettingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('test_resource', [AdminController::class, 'index']);
Route::get('/', [HomeController::class, 'home'])->name('home');

Route::post('/set-locale', [SettingController::class, 'setLocale'])->name('set-locale');

Route::prefix('shop')->name('shop.')->group(function () {

    // ========================= Customers
    Route::get('/signin', [CustomerController::class, 'signin'])->name('signin');
    Route::get('/signup', [CustomerController::class, 'signup'])->name('signup');
    Route::get('/signout', function () {
        auth('customer')->logout();
    })->name('signout');
    Route::post('/authenticate', [CustomerController::class, 'authenticate'])->name('authenticate');
    Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');

    Route::middleware(['customerauth'])->group(function () {
        Route::put('/customer/update', [CustomerController::class, 'update'])->name('customer.update');
        Route::post('/cart-items/store', [CustomerController::class, 'storeCartItems'])->name('cart_items.store'); // ToDo
        Route::post('/order/store', [CustomerController::class, 'storeOrder'])->name('order.store');
        Route::get('/cart-info', [CustomerController::class, 'cartInfo'])->name('cart.info');

        Route::get('/profile', [CustomerController::class, 'profile'])->name('customer.profile');
        Route::get('/signout', [CustomerController::class, 'logout'])->name('signout');
    });
    // ======================== Products
    Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

    // ======================== Media
    Route::get('/media/{uuid}', [HomeController::class, 'media'])->name('media');

    // ======================== Categories
    Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');

    // ======================== TEMPORARY ROUTES
    Route::get('/cart', function () {
        return Inertia::render('web/CartView');
    })->name('cart.show');

    Route::get('/contactus', function () {
        return Inertia::render('web/ContactUsView');
    })->name('contactus.show');

    Route::get('/aboutus', function () {
        return Inertia::render('web/AboutUsView');
    })->name('aboutus.show');
});

/* Route::get('/product/{id}', function ($id) {
        return Inertia::render('web/ProductView', [
            'productId' => $id,
        ]);
    })->name('product.show');

Route::get('/category/{name}/', function ($name) {
    return Inertia::render('web/CategoryView', [
        'title' => strtoupper($name),
        'subtitle' => request('subtitle'),
        'banner' => request('banner'),
    ]);
})->name('web.category');
*/

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/activity.php';
