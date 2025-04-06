<?php

namespace App\Http\Controllers\Web;

use App\Actions\Categories\FeaturedCategoryIndex;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home()
    {
        return Inertia::render('Welcome', [
            'categories' => app(FeaturedCategoryIndex::class)->execute(),
        ]);
    }
}
