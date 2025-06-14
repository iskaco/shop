<?php

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Admins\AttributeController;
use App\Http\Controllers\Admins\AttributeValueController;
use App\Http\Controllers\Admins\BrandController;
use App\Http\Controllers\Admins\CartController;
use App\Http\Controllers\Admins\CategoryController;
use App\Http\Controllers\Admins\CustomerController;
use App\Http\Controllers\Admins\FormController;
use App\Http\Controllers\Admins\OrderController;
use App\Http\Controllers\Admins\OrderItemController;
use App\Http\Controllers\Admins\PaymentMethodController;
use App\Http\Controllers\Admins\ProductController;
use App\Http\Controllers\Admins\SpecificationController;
use App\Http\Controllers\Admins\TableController;
use App\Http\Controllers\Admins\TaxController;
use App\Http\Controllers\Admins\VendorController;
use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/test-admin', [AdminController::class, 'index']);
Route::get('/admin-login', fn () => Inertia::render('Auth/AdminLogin'))->name('admin.login');
Route::post('/admin-authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');
Route::get('/signin', fn () => Inertia::render('Auth/Login'))->name('admin.signin');
Route::prefix('admin')->name('admin.')->middleware('adminauth')->group(function () {
    Route::get('/dashboard', fn () => Inertia::render('Dashboard'))->name('dashboard');
    Route::get('/calendar', fn () => Inertia::render('CalendarView'))->name('calendar');
    Route::get('/profile', fn () => Inertia::render('ProfileView'))->name('profile');
    Route::get('/tables', fn () => Inertia::render('TablesView'))->name('tables');
    Route::get('/settings', fn () => Inertia::render('SettingsView'))->name('settings');
    Route::get('/alerts', fn () => Inertia::render('AlertsView'))->name('alerts');
    Route::get('/buttons', fn () => Inertia::render('buttonsView'))->name('buttons');
    Route::get('/form-elements', fn () => Inertia::render('Forms/FormElementsView'))->name('form.elements');
    Route::get('/form-layouts', fn () => Inertia::render('Forms/FormLayoutView'))->name('form.layouts');
    Route::get('/basic-chart', fn () => Inertia::render('Charts/BasicChartView'))->name('chart.basics');
    Route::get('/signup', fn () => Inertia::render('Authentication/SignupView'))->name('signup');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/table/media/{model}/{id}/{attribute}/{multiple}', [TableController::class, 'getMedia'])->name('table.getMedia');
    Route::get('/form/media/{model}/{id}/{attribute}/{multiple}', [FormController::class, 'getMedia'])->name('form.getMedia');
    Route::get('/media/{uuid}', [HomeController::class, 'media'])->name('media');

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
    Route::get('/product/specifications/{id}', [ProductController::class, 'specifications'])->name('product.specifications');
    Route::put('/product/specifications/{id}', [ProductController::class, 'updateSpecifications'])->name('product.specifications.update');
    Route::get('/product/attributes/{id}', [ProductController::class, 'attributes'])->name('product.attributes');
    Route::put('/product/attributes/{id}', [ProductController::class, 'updateAttributes'])->name('product.attributes.update');
    Route::get('/product/variants/{id}', [ProductController::class, 'variants'])->name('product.variants');
    Route::put('/product/variants/{id}', [ProductController::class, 'updateVariants'])->name('product.variants.update');

    // Category Routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/category', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');

    Route::get('/category/products/{id}', [CategoryController::class, 'products'])->name('category.products');

    // Brand Routes
    Route::get('/brands', [BrandController::class, 'index'])->name('brands');
    Route::get('/brand', [BrandController::class, 'create'])->name('brand.create');
    Route::post('/brand', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/brand/{id}', [BrandController::class, 'show'])->name('brand.show');
    Route::put('/brand/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::delete('/brand/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');

    // Specification Routes
    Route::get('/specifications', [SpecificationController::class, 'index'])->name('specifications');
    Route::get('/specification', [SpecificationController::class, 'create'])->name('specification.create');
    Route::post('/specification', [SpecificationController::class, 'store'])->name('specification.store');
    Route::get('/specification/{id}', [SpecificationController::class, 'show'])->name('specification.show');
    Route::put('/specification/{id}', [SpecificationController::class, 'update'])->name('specification.update');
    Route::delete('/specification/{id}', [SpecificationController::class, 'destroy'])->name('specification.destroy');
    Route::get('/specification/edit/{id}', [SpecificationController::class, 'edit'])->name('specification.edit');

    // Order Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/order', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::put('/order/{id}', [OrderController::class, 'update'])->name('order.update');
    Route::delete('/order/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::get('/order/edit/{id}', [OrderController::class, 'edit'])->name('order.edit');
    Route::get('/order-items/{id}', [OrderController::class, 'orderItems'])->name('order.order_items');

    // OrderItem Routes
    Route::get('/order_item/{id}', [OrderItemController::class, 'show'])->name('order_item.show');

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

    // Vendor Routes
    Route::get('/vendors', [VendorController::class, 'index'])->name('vendors');
    Route::get('/vendor', [VendorController::class, 'create'])->name('vendor.create');
    Route::post('/vendor', [VendorController::class, 'store'])->name('vendor.store');
    Route::get('/vendor/{id}', [VendorController::class, 'show'])->name('vendor.show');
    Route::put('/vendor/{id}', [VendorController::class, 'update'])->name('vendor.update');
    Route::delete('/vendor/{id}', [VendorController::class, 'destroy'])->name('vendor.destroy');
    Route::get('/vendor/edit/{id}', [VendorController::class, 'edit'])->name('vendor.edit');

    // Customer Routes
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::get('/customer/{id}', [CustomerController::class, 'show'])->name('customer.show');
    Route::get('/customer/orders/{id}', [CustomerController::class, 'orders'])->name('customer.orders');

    // Attribute Routes
    Route::get('/attributes', [AttributeController::class, 'index'])->name('attributes');
    Route::get('/attribute', [AttributeController::class, 'create'])->name('attribute.create');
    Route::post('/attribute', [AttributeController::class, 'store'])->name('attribute.store');
    Route::get('/attribute/{id}', [AttributeController::class, 'show'])->name('attribute.show');
    Route::put('/attribute/{id}', [AttributeController::class, 'update'])->name('attribute.update');
    Route::delete('/attribute/{id}', [AttributeController::class, 'destroy'])->name('attribute.destroy');
    Route::get('/attribute/edit/{id}', [AttributeController::class, 'edit'])->name('attribute.edit');

    // AttributeValue Routes

    Route::get('/attribute_values', [AttributeValueController::class, 'index'])->name('attribute_values');
    Route::get('/attribute_value', [AttributeValueController::class, 'create'])->name('attribute_value.create');
    Route::post('/attribute_value', [AttributeValueController::class, 'store'])->name('attribute_value.store');
    Route::get('/attribute_value/{id}', [AttributeValueController::class, 'show'])->name('attribute_value.show');
    Route::put('/attribute_value/{id}', [AttributeValueController::class, 'update'])->name('attribute_value.update');
    Route::delete('/attribute_value/{id}', [AttributeValueController::class, 'destroy'])->name('attribute_value.destroy');
    Route::get('/attribute_value/edit/{id}', [AttributeValueController::class, 'edit'])->name('attribute_value.edit');

    // PaymentMethod Routes
    Route::get('/payment_methods', [PaymentMethodController::class, 'index'])->name('payment_methods');
    Route::get('/payment_method', [PaymentMethodController::class, 'create'])->name('payment_method.create');
    Route::post('/payment_method', [PaymentMethodController::class, 'store'])->name('payment_method.store');
    Route::get('/payment_method/{id}', [PaymentMethodController::class, 'show'])->name('payment_method.show');
    Route::put('/payment_method/{id}', [PaymentMethodController::class, 'update'])->name('payment_method.update');
    Route::delete('/payment_method/{id}', [PaymentMethodController::class, 'destroy'])->name('payment_method.destroy');
    Route::get('/payment_method/edit/{id}', [PaymentMethodController::class, 'edit'])->name('payment_method.edit');

});
