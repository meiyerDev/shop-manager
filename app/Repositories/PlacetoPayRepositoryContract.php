<?php

namespace App\Repositories;

use App\Models\Order;

interface PlacetoPayRepositoryContract extends EloquentRepositoryContract
{
    /**
     * Create payment request by order id
     * 
     * @param Order $orderId
     * @return array
     */
    public function createRequestPaymentByOrder(Order $order): array;
}
