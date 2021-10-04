<?php

namespace App\Http\Controllers;

use App\Repositories\OrderRepositoryContract;
use App\Repositories\PlacetoPayRepositoryContract;
use Illuminate\Http\Response;

class OrderPlacetoPayController extends Controller
{
    public function __invoke(
        OrderRepositoryContract $orderRepository,
        PlacetoPayRepositoryContract $placetoPayRepository,
        int $orderId
    ) {
        $order = $orderRepository->findOrFail($orderId);
        $this->authorize('view', $order);

        $data = $placetoPayRepository->createRequestPaymentByOrder($order);

        if (isset($data['process_url'])) {
            return $this->successResponse($data, Response::HTTP_CREATED);
        }

        return $this->errorResponse($data, Response::HTTP_SERVICE_UNAVAILABLE);
    }
}
