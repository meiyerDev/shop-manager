<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Collections\OrderResourceCollection;
use App\Models\Order;
use App\Repositories\OrderRepositoryContract;
use Illuminate\Http\Request;

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
        $orders = $this->orderRepository->getAllPaginated(
            (int) $request->query('limit', 15)
        );

        return $this->successResponse(
            new OrderResourceCollection($orders)
        );
    }
}
