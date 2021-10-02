<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Collections\ProductResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'customer_name' => $this->customer_name,
            'customer_email' => $this->customer_email,
            'customer_mobile' => $this->customer_mobile,
            'status' => $this->status,
            'products' => new ProductResourceCollection($this->whenLoaded('products')),
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),
        ];
    }
}
