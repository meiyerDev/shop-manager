<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Resources\Collections\OrderResourceCollection;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use App\Repositories\OrderRepositoryContract;
use Illuminate\Http\Request;
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
     * Return all orders by auth
     */
    public function index(Request $request)
    {
        $orders = $this->orderRepository->getOnlyUserPaginated(
            Auth::id(),
            (int) $request->query('limit', 15)
        );

        return $this->successResponse(
            new OrderResourceCollection($orders)
        );
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

    /**
     * Show an order data
     * 
     * @param int $order
     */
    public function show(int $order)
    {
        $order = $this->orderRepository->findOrFail($order);
        $this->authorize('view', $order);

        return $this->successResponse(
            OrderResource::make($order->loadMissing('products'))
        );
    }
}
