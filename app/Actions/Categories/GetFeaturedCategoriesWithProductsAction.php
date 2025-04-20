<?php

namespace App\Actions\Categories;

use App\Actions\BaseAction;
use App\Http\Resources\FeaturedCategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class GetFeaturedCategoriesWithProductsAction extends BaseAction
{
    public function execute(int $productsLimit = 12, bool $useCache = true)
    {
        if ($useCache) {
            $categories = Cache::remember(
                'featured_categories_with_products',
                now()->addHours(6),
                fn () => $this->fetchCategories($productsLimit)
            );
        } else {
            $categories = $this->fetchCategories($productsLimit);
        }

        return FeaturedCategoryResource::collection($categories);
    }

    protected function fetchCategories(int $productsLimit)
    {
        return Category::with(['products' => function ($query) use ($productsLimit) {
            $query->inRandomOrder()->limit($productsLimit);
        }])
            ->featured()
            ->get();
    }
}
