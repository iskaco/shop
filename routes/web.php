<?php

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Admins\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\SettingController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('test_resource', [AdminController::class, 'index']);
Route::get('/', [HomeController::class, 'home'])->name('home');


Route::post('/set-locale', [SettingController::class, 'setLocale'])->name('set-locale');

Route::prefix('shop')->name('shop.')->group(function () {
    //======================== Products
    Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

    //======================== Categories
    Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');


    //======================== Brands



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
