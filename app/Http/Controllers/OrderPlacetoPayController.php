<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Repositories\OrderRepositoryContract;
use App\Repositories\PlacetoPayRepositoryContract;
use Illuminate\Http\Response;
use Dnetix\Redirection;

class OrderPlacetoPayController extends Controller
{
    /** @var OrderRepositoryContract */
    private $orderRepository;

    /** @var PlacetoPayRepositoryContract */
    private $placetoPayRepository;

    function __construct(
        OrderRepositoryContract $orderRepository,
        PlacetoPayRepositoryContract $placetoPayRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->placetoPayRepository = $placetoPayRepository;
    }

    /**
     * Create payment request by Order id
     */
    public function createPaymentRequest(
        int $orderId
    ) {
        $order = $this->orderRepository->findOrFail($orderId);
        $this->authorize('view', $order);

        $data = $this->placetoPayRepository->createRequestPaymentByOrder($order);

        if (isset($data['process_url'])) {
            return $this->successResponse($data, Response::HTTP_CREATED);
        }

        return $this->errorResponse($data, Response::HTTP_SERVICE_UNAVAILABLE);
    }

    /**
     * Receive user from placetoPay flow successfull
     */
    public function receivedSuccessful(
        int $orderId,
        string $referenceId
    ) {
        /** @var Order */
        $order = $this->orderRepository->findOrFail($orderId);
        $this->authorize('view', $order);

        $route = $this->placetoPayRepository->updateOrderByPlacetoPay($order, $referenceId);

        return redirect()->to($route);
    }

    /**
     * Receive user from placetoPay flow canceled
     */
    public function receivedcanceled(
        int $orderId,
        string $referenceId
    ) {
        /** @var Order */
        $order = $this->orderRepository->findOrFail($orderId);
        $this->authorize('view', $order);

        $route = $this->placetoPayRepository->cancelOrderByPlacetoPay($order, $referenceId);

        return redirect()->to($route);
    }
}
