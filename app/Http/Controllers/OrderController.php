<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use App\Repositories\OrderRepositoryContract;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /** @var OrderRepositoryContract */
    private $orderRepository;

    function __construct(OrderRepositoryContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Create a new order
     * 
     * @param CreateOrderRequest $request
     */
    public function store(CreateOrderRequest $request)
    {
        /** @var Order */
        $order = $this->orderRepository->create(
            $request->only([
                'customer_name',
                'customer_email',
                'customer_mobile',
                'product_id'
            ]),
            Auth::id()
        );

        return $this->successResponse(
            OrderResource::make($order->loadMissing('products')),
            Response::HTTP_CREATED
        );
    }
}
