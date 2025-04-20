<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeaturedCategoryResource extends JsonResource
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
            'image' => $this?->image?->uuid,
            'banner' => $this?->banner?->uuid,
            'description' => $this?->description,
            // 'is_featured' => $this?->is_featured,
            'products' => ProductResource::collection($this->whenLoaded('products')),
            // 'created_at' => $this?->created_at?->format('Y-m-d H:i:s'),
            'links' => [
                'self' => route('shop.category.show', $this->slug),
            ],
        ];
    }
}
