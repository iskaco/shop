<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $products = Product::all();
        foreach ($products as $product) {
            $media_path = $this->getRandomMedia();
            if (! $product->image) {
                $product->copyMedia($media_path)->usingName($product->name)->toMediaCollection('Product.Images');
            }
        }
    }

    private function getRandomMedia()
    {
        $media_path = '';
        while (! file_exists($media_path)) {
            $media_path = Media::inRandomOrder()?->first()?->getPath();
        }

        return $media_path;
    }
}
