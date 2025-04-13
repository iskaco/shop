<?php

namespace App\Http\Controllers\Web;

use App\Actions\Categories\FeaturedCategoryIndex;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use Inertia\Inertia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class HomeController extends Controller
{
    public function home()
    {
        $categories = app(FeaturedCategoryIndex::class)->execute();
        $random_products = $this->randomProduct();

        return Inertia::render('Welcome', [
            'categories' => CategoryResource::collection($categories),
            'random_products' => ProductResource::collection($random_products),
        ]);
    }

    public function media($uuid)
    {
        try {
            return Media::findByUuid($uuid) ?? null;
        } catch (\Throwable $th) {
            // throw $th;
        }
    }

    public function randomProduct()
    {
        $selected_category_slug = 'electronics'; // TODO
        $category = Category::where('slug', $selected_category_slug)->first() ?? Category::inRandomOrder()->first();
        $product = $category->products()->inRandomOrder()->take(4)->get();

        return $product;
    }
}
