<?php

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Admins\BrandController;
use App\Http\Controllers\Admins\CartController;
use App\Http\Controllers\Admins\CategoryController;
use App\Http\Controllers\Admins\FormController;
use App\Http\Controllers\Admins\OrderController;
use App\Http\Controllers\Admins\ProductController;
use App\Http\Controllers\Admins\TableController;
use App\Http\Controllers\Admins\TaxController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/test-admin', [AdminController::class, 'index']);
Route::get('/admin-login', fn() => Inertia::render('Auth/AdminLogin'))->name('admin.login');
Route::post('/admin-authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');
Route::get('/signin', fn() => Inertia::render('Auth/Login'))->name('admin.signin');
Route::prefix('admin')->name('admin.')->middleware('adminauth')->group(function () {
    Route::get('/dashboard', fn() => Inertia::render('Dashboard'))->name('dashboard');
    Route::get('/calendar', fn() => Inertia::render('CalendarView'))->name('calendar');
    Route::get('/profile', fn() => Inertia::render('ProfileView'))->name('profile');
    Route::get('/tables', fn() => Inertia::render('TablesView'))->name('tables');
    Route::get('/settings', fn() => Inertia::render('SettingsView'))->name('settings');
    Route::get('/alerts', fn() => Inertia::render('AlertsView'))->name('alerts');
    Route::get('/buttons', fn() => Inertia::render('buttonsView'))->name('buttons');
    Route::get('/form-elements', fn() => Inertia::render('Forms/FormElementsView'))->name('form.elements');
    Route::get('/form-layouts', fn() => Inertia::render('Forms/FormLayoutView'))->name('form.layouts');
    Route::get('/basic-chart', fn() => Inertia::render('Charts/BasicChartView'))->name('chart.basics');
    Route::get('/signup', fn() => Inertia::render('Authentication/SignupView'))->name('signup');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/table/media/{model}/{id}/{attribute}/{multiple}', [TableController::class, 'getMedia'])->name('table.getMedia');
    Route::get('/form/media/{model}/{id}/{attribute}/{multiple}', [FormController::class, 'getMedia'])->name('form.getMedia');

    // Admin Routes
    Route::get('/admin', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
    Route::put('/admin/{admin}', [AdminController::class, 'update'])->name('admin.update');
    Route::get('/admins', [AdminController::class, 'index'])->name('admins');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::get('/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    // Product Routes
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/product', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');

    // Category Routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/category', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');

    // Brand Routes
    Route::get('/brands', [BrandController::class, 'index'])->name('brands');
    Route::get('/brand', [BrandController::class, 'create'])->name('brand.create');
    Route::post('/brand', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/brand/{id}', [BrandController::class, 'show'])->name('brand.show');
    Route::put('/brand/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::delete('/brand/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');

    // Order Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/order', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::put('/order/{id}', [OrderController::class, 'update'])->name('order.update');
    Route::delete('/order/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::get('/order/edit/{id}', [OrderController::class, 'edit'])->name('order.edit');

    // Cart Routes
    Route::get('/carts', [CartController::class, 'index'])->name('carts');
    Route::get('/cart', [CartController::class, 'create'])->name('cart.create');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart/{id}', [CartController::class, 'show'])->name('cart.show');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/cart/edit/{id}', [CartController::class, 'edit'])->name('cart.edit');

    // Tax Routes
    Route::get('/taxes', [TaxController::class, 'index'])->name('taxes');
    Route::get('/tax', [TaxController::class, 'create'])->name('tax.create');
    Route::post('/tax', [TaxController::class, 'store'])->name('tax.store');
    Route::get('/tax/{id}', [TaxController::class, 'show'])->name('tax.show');
    Route::put('/tax/{id}', [TaxController::class, 'update'])->name('tax.update');
    Route::delete('/tax/{id}', [TaxController::class, 'destroy'])->name('tax.destroy');
    Route::get('/tax/edit/{id}', [TaxController::class, 'edit'])->name('tax.edit');
});
