<?php

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Web\SettingController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('test_resource', [AdminController::class, 'index']);
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::post('/set-locale', [SettingController::class, 'setLocale'])->name('set-locale');

/* Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/calendar', function () {
    return Inertia::render('CalendarView');
})->middleware(['auth', 'verified'])->name('calendar'); */

Route::middleware('auth')->group(function () {
    /* Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); */
});

Route::get('/product/{id}', function ($id) {
    return Inertia::render('web/ProductView', [
        'productId' => $id,
    ]);
})->name('product.show');

Route::get('/category/{name}/', function ($name) {
    return Inertia::render('web/CategoryView', [
        'title' => $name,
        'subtitle' => request('subtitle'),
        'banner' => request('banner'),
    ]);
})->name('web.category');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/activity.php';
