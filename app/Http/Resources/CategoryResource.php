<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this?->name,
            'slug' => $this?->slug,
            'description' => $this?->description,
            'short_description' => $this?->short_description,
            'image' => $this?->image,
            'thumbnail' => $this?->thumbnail,
            'banner' => $this?->banner,
            'products_count' => $this?->products_count,
            //'products' => ProductResource::collection($this?->products),
            'links' => [
                'self' => route('shop.category.show', ['slug' => $this?->slug]),
            ],

        ];
    }
}
