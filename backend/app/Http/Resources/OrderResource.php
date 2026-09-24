<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'order_id'     => $this->order_id,
            'total_amount' => $this->total_amount,
            'order_status' => $this->order_status,
            'pickup_date'  => $this->pickup_date,
            'pickup_slot'  => $this->pickup_slot,
            'notes'        => $this->notes,
            'items'        => $this->whenLoaded('items'),
            'farmer'       => $this->whenLoaded('farmer'),
            'customer'     => $this->whenLoaded('customer'),
            'created_at'   => $this->created_at,
        ];
    }
}