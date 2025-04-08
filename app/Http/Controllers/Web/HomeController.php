<?php

namespace App\Http\Controllers\Web;

use App\Actions\Categories\FeaturedCategoryIndex;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Inertia\Inertia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class HomeController extends Controller
{
    public function home()
    {
        $categories = app(FeaturedCategoryIndex::class)->execute();

        return Inertia::render('Welcome', [
            'categories' => CategoryResource::collection($categories),
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
}
