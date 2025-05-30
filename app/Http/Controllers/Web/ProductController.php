<?php

namespace App\Http\Controllers\Web;

use App\Actions\Products\ProductFindVariant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Products\ProductFindVariantRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductVariantResource;
use App\Models\Product;
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
            // throw $th;
        }
    }

    public function findVariant(ProductFindVariantRequest $request, ProductFindVariant $action, string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $product_variant = $action->execute($request->validated(), $product?->id);
        if (! $product_variant) {
            return redirect()->back();
        }

        /*return back()->([
            'product' => new ProductResource($product),
            'product_variant' => new ProductVariantResource($product_variant),
        ]);*/
        return Inertia::render('web/ProductView', [
            'product' => new ProductResource($product),
            'product_variant' => new ProductVariantResource($product_variant),
        ]);
    }
}
