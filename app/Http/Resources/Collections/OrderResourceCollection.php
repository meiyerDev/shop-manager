<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\Order\OrderResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderResourceCollection extends ResourceCollection
{
    public $collects = OrderResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->resource;
    }
}
