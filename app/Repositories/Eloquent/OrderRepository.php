<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Models\Product;
use App\Repositories\OrderRepositoryContract;

class OrderRepository extends EloquentRepository implements OrderRepositoryContract
{
    function __construct(Order $model)
    {
        parent::__contruct($model);
    }

    /**
     * Find order by primary key or fail
     * 
     * @param int $primary
     * @return Order
     * @throws ModelNotFoundException
     */
    public function findOrFail(int $primary): Order
    {
        return $this->model->with('products')->findOrFail($primary);
    }

    /**
     * Create a new order
     * 
     * @param array $data
     * @param int $userId 
     */
    public function create(array $data, int $userId)
    {
        $product = Product::findOrFail($data['product_id']);

        unset($data['product_id']);
        $data = $data + ['user_id' => $userId];

        /** @var Order */
        $order = Order::create($data);

        $order->products()->attach($product->id);

        return $order->load('products');
    }
}
