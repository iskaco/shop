<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    //
    public function index() {}

    public function show(string $slug)
    {
        try {
            $product = Product::where('slug', $slug)->firstOrFail();
            return Inertia::render('web/ProductView', [
                'product' => new ProductResource($product),
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
