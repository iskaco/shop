<?php

namespace App\Http\Controllers\Web;

use App\Actions\Categories\FeaturedCategoryIndex;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home()
    {
        $categories = app(FeaturedCategoryIndex::class)->execute();
        return Inertia::render('Welcome', [
            'categories' => CategoryResource::collection($categories),
        ]);
    }
}
