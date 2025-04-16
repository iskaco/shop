<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            [
                'status' => $this?->status,
                'subtotal' => $this?->subtotal,
                'tax_amount' => $this?->tax_amount,
                'discount_amount' => $this?->discount_amount,
                'shipping_cost' => $this?->shipping_cost,
                'total' => $this?->total,
                'payment_method' => $this?->payment_method,
                'shipping_address' => $this?->shipping_address,
                'items' => OrderItemResource::collection($this?->items),
                'created_at' => $this?->created_at?->format('Y-m-d H:i:s'),
            ],
        ];
    }
}
