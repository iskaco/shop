<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this?->id,
            'name' => $this?->name,
            'description' => $this?->description,
            'short_description' => $this?->short_description,
            'slug' => $this?->slug,
            'image' => $this?->image?->uuid,
            'price' => $this?->price,
            'cost' => $this?->cost,
            'stock' => $this?->stock,
            'category' => $this?->category?->name,
            'brand' => $this?->brand?->name,
            'vendor' => $this?->vendor?->name,
            'specifications' => $this?->specifications,
        ];
    }
}
