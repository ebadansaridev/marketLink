<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'product_id'     => $this->product_id,
            'name'           => $this->name,
            'description'    => $this->description,
            'price'          => $this->price,
            'unit'           => $this->unit,
            'stock_quantity' => $this->stock_quantity,
            'image'          => $this->image,
            'is_available'   => $this->is_available,
            'category'       => $this->whenLoaded('category'),
            'farmer'         => $this->whenLoaded('farmer'),
        ];
    }
}