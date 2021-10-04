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

    /**
     * Update order by placeto pay status
     * 
     * @param Order $order
     * @param string $referenceId
     * @return string
     */
    public function updateOrderByPlacetoPay(Order $order, string $referenceId): string;

    /**
     * Cancel order by placeto pay status
     * 
     * @param Order $order
     * @param string $referenceId
     * @return string
     */
    public function cancelOrderByPlacetoPay(Order $order, string $referenceId): string;
}
