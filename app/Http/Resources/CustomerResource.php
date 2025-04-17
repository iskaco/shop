<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'login_type' => $this?->login_type,
            'email' => $this?->email,
            'mobile' => $this?->mobile,
            'enable' => $this?->enable,
            'country' => $this?->country,
            'city' => $this?->city,
            'address' => $this?->address,
            'postal_code' => $this?->postal_code,
            'profile_image' => $this?->profile_image,
            'orders' => OrderResource::collection($this?->orders),
        ];
    }
}
