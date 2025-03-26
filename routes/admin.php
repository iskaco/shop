<?php

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Admins\FormController;
use App\Http\Controllers\Admins\ProductController;
use App\Http\Controllers\Admins\TableController;
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
    Route::get('/table/media/{model}/{id}/{attribute}/{multiple}', [TableController::class , 'getMedia'])->name('table.getMedia');
    Route::get('/form/media/{model}/{id}/{attribute}/{multiple}', [FormController::class , 'getMedia'])->name('form.getMedia');


    // Admin Routes
    Route::get('/admin', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
    Route::put('/admin/{admin}', [AdminController::class, 'update'])->name('admin.update');
    Route::get('/admins', [AdminController::class, 'index'])->name('admins');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::get('/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    // Product Routes
    Route::get('/products',[ProductController::class,'index'])->name('products');
    Route::get('/product', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');


});
